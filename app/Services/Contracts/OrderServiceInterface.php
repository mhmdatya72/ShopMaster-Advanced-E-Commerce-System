<?php

namespace App\Services\Contracts;

use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderServiceInterface
{
    /**
     * Create order from cart.
     */
    public function createOrderFromCart(Cart $cart, array $orderData): Order;

    /**
     * Get orders for user.
     */
    public function getUserOrders(User $user, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get order by ID.
     */
    public function getOrderById(int $id): ?Order;

    /**
     * Update order status.
     */
    public function updateOrderStatus(Order $order, string $status): Order;

    /**
     * Cancel order.
     */
    public function cancelOrder(Order $order): Order;

    /**
     * Calculate order totals.
     */
    public function calculateOrderTotals(Cart $cart, ?string $couponCode = null, ?int $shippingMethodId = null): array;
}
