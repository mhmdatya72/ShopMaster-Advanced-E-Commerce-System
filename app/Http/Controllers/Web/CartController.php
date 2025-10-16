<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CartServiceInterface;
use App\Services\Contracts\CouponServiceInterface;
use App\Services\Contracts\ShippingServiceInterface;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\ApplyCouponRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private CartServiceInterface $cartService,
        private CouponServiceInterface $couponService,
        private ShippingServiceInterface $shippingService
    ) {}

    /**
     * Display the cart.
     */
    public function index()
    {
        $cart = $this->cartService->getOrCreateCart(
            auth()->id(),
            session()->getId()
        );

        $shippingMethods = $this->shippingService->getActiveShippingMethods();

        return view('cart.index', compact('cart', 'shippingMethods'));
    }

    /**
     * Get cart items count.
     */
    public function count()
    {
        $cart = $this->cartService->getOrCreateCart(
            auth()->id(),
            session()->getId()
        );

        $count = $this->cartService->getCartItemsCount($cart);

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = $this->cartService->getOrCreateCart(
            auth()->id(),
            session()->getId()
        );

        try {
            $this->cartService->addToCart($cart, $product, $request->quantity);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'cart_count' => $this->cartService->getCartItemsCount($cart)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update cart item.
     */
    public function update(Request $request)
    {
        // Manual validation to ensure JSON response
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $product = Product::findOrFail($request->product_id);
            $cart = $this->cartService->getOrCreateCart(
                auth()->id(),
                session()->getId()
            );

            $cartItem = $this->cartService->getCartItemForProduct($cart, $product);

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ], 404);
            }

            $this->cartService->updateCartItem($cartItem, $request->quantity);
            $updatedItem = $cartItem->fresh();

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'item_total' => $updatedItem->formatted_total,
                'unit_price' => $updatedItem->formatted_price,
                'quantity' => $updatedItem->quantity,
                'max_qty' => $updatedItem->product->stock,
                'cart_subtotal' => $this->cartService->getCartSubtotal($cart),
                'cart_total' => $this->cartService->getCartTotal($cart),
                'cart_items_count' => $this->cartService->getCartItemsCount($cart)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        // Manual validation to ensure JSON response
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $product = Product::findOrFail($request->product_id);
            $cart = $this->cartService->getOrCreateCart(
                auth()->id(),
                session()->getId()
            );

            $cartItem = $this->cartService->getCartItemForProduct($cart, $product);

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ], 404);
            }

            $this->cartService->removeFromCart($cartItem);

            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Apply coupon to cart.
     */
    public function applyCoupon(Request $request)
    {
        // Manual validation to ensure JSON response
        $validator = \Validator::make($request->all(), [
            'code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $cart = $this->cartService->getOrCreateCart(
                auth()->id(),
                session()->getId()
            );

            $result = $this->couponService->applyCoupon(
                $request->code,
                $this->cartService->getCartTotal($cart),
                auth()->id()
            );

            if ($result['success']) {
                session(['applied_coupon' => $result['coupon']]);
            }

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove coupon from cart.
     */
    public function removeCoupon()
    {
        session()->forget('applied_coupon');

        return response()->json([
            'success' => true,
            'message' => 'Coupon removed successfully'
        ]);
    }

    /**
     * Update shipping method.
     */
    public function updateShippingMethod(Request $request)
    {
        // Manual validation to ensure JSON response
        $validator = \Validator::make($request->all(), [
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $cart = $this->cartService->getOrCreateCart(
                auth()->id(),
                session()->getId()
            );

            // Store selected shipping method in session
            session(['selected_shipping_method' => $request->shipping_method_id]);

            return response()->json([
                'success' => true,
                'message' => 'Shipping method updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get updated cart totals.
     */
    public function getTotals()
    {
        $cart = $this->cartService->getOrCreateCart(
            auth()->id(),
            session()->getId()
        );

        $subtotal = $this->cartService->getCartSubtotal($cart);

        // Get shipping cost
        $shippingCost = 0;
        if (session('selected_shipping_method')) {
            $shippingMethod = \App\Models\ShippingMethod::find(session('selected_shipping_method'));
            if ($shippingMethod) {
                $shippingCost = $shippingMethod->cost;
            }
        }

        // Calculate discount
        $discount = 0;
        if (session('applied_coupon')) {
            $coupon = session('applied_coupon');
            $discount = $subtotal * ($coupon['discount_percentage'] / 100);
        }

        // Calculate total
        $total = $subtotal + $shippingCost - $discount;

        return response()->json([
            'success' => true,
            'totals' => [
                'subtotal' => (float) $subtotal,
                'shipping' => (float) $shippingCost,
                'discount' => (float) $discount,
                'total' => (float) $total
            ]
        ]);
    }
}
