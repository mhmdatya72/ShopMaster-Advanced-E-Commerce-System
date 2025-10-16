<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\OrderItem;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\CouponServiceInterface;
use App\Services\Contracts\ShippingServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        private CouponServiceInterface $couponService,
        private ShippingServiceInterface $shippingService
    ) {}

    /**
     * Create order from cart.
     */
    public function createOrderFromCart(Cart $cart, array $orderData): Order
    {
        return DB::transaction(function () use ($cart, $orderData) {
            $totals = $this->calculateOrderTotals(
                $cart,
                $orderData['coupon_code'] ?? null,
                $orderData['shipping_method_id'] ?? null
            );

            $order = Order::create([
                'user_id' => $cart->user_id,
                'subtotal' => $totals['subtotal'],
                'shipping_cost' => $totals['shipping_cost'],
                'discount_amount' => $totals['discount_amount'],
                'total_amount' => $totals['total_amount'],
                'coupon_id' => $totals['coupon_id'],
                'shipping_method_id' => $totals['shipping_method_id'],
                'status' => 'pending',
                'shipping_address' => $orderData['shipping_address'],
                'billing_address' => $orderData['billing_address'],
                'notes' => $orderData['notes'] ?? null,
            ]);

            // Create order items
            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                ]);

                // Update product stock
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Increment coupon usage if applied
            if ($totals['coupon_id']) {
                $order->coupon->incrementUsage();
            }

            // Clear cart
            $cart->clear();

            return $order->load(['orderItems.product', 'coupon', 'shippingMethod']);
        });
    }

    /**
     * Get orders for user.
     */
    public function getUserOrders(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return $user->orders()
            ->with(['orderItems.product', 'coupon', 'shippingMethod'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get order by ID.
     */
    public function getOrderById(int $id): ?Order
    {
        return Order::with(['orderItems.product', 'coupon', 'shippingMethod', 'user'])
            ->find($id);
    }

    /**
     * Update order status.
     */
    public function updateOrderStatus(Order $order, string $status): Order
    {
        $order->update(['status' => $status]);

        return $order->fresh();
    }

    /**
     * Cancel order.
     */
    public function cancelOrder(Order $order): Order
    {
        if (!$order->canBeCancelled()) {
            throw new \Exception('Order cannot be cancelled');
        }

        // Restore product stock
        foreach ($order->orderItems as $orderItem) {
            $orderItem->product->increment('stock', $orderItem->quantity);
        }

        return $this->updateOrderStatus($order, 'cancelled');
    }

    /**
     * Calculate order totals.
     */
    public function calculateOrderTotals(Cart $cart, ?string $couponCode = null, ?int $shippingMethodId = null): array
    {
        $subtotal = $cart->subtotal;
        $discountAmount = 0;
        $couponId = null;
        $shippingCost = 0;
        $shippingMethodId = null;

        // Apply coupon if provided
        if ($couponCode) {
            $couponResult = $this->couponService->applyCoupon($couponCode, $subtotal);
            if ($couponResult['success']) {
                $discountAmount = $couponResult['discount'];
                $couponId = $couponResult['coupon']->id;
            }
        }

        // Calculate shipping cost
        if ($shippingMethodId) {
            $shippingMethod = $this->shippingService->getShippingMethodById($shippingMethodId);
            if ($shippingMethod) {
                $shippingCost = $this->shippingService->calculateShippingCost($shippingMethod, $subtotal);
            }
        }

        // Calculate total amount
        $totalAmount = $subtotal - $discountAmount + $shippingCost;

        return [
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'coupon_id' => $couponId,
            'shipping_method_id' => $shippingMethodId,
        ];
    }
}
