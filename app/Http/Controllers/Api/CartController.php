<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Resources\CartResource;
use App\Services\Contracts\CartServiceInterface;
use App\Services\Contracts\CouponServiceInterface;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\ApplyCouponRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{
    public function __construct(
        private CartServiceInterface $cartService,
        private CouponServiceInterface $couponService
    ) {
        $this->middleware('auth:api');
    }

    /**
     * Get user's cart.
     */
    public function index(): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart(Auth::id());

        return response()->json([
            'success' => true,
            'data' => new CartResource($cart)
        ]);
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = $this->cartService->getOrCreateCart(Auth::id());

        try {
            $this->cartService->addToCart($cart, $product, $request->quantity);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully',
                'data' => new CartResource($cart->fresh()->load('cartItems.product'))
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
    public function update(UpdateCartRequest $request): JsonResponse
    {
        $product = Product::findOrFail($request->product_id);
        $cart = $this->cartService->getOrCreateCart(Auth::id());

        $cartItem = $this->cartService->getCartItemForProduct($cart, $product);

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart'
            ], 404);
        }

        try {
            $this->cartService->updateCartItem($cartItem, $request->quantity);

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'data' => new CartResource($cart->fresh()->load('cartItems.product'))
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
    public function remove(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = $this->cartService->getOrCreateCart(Auth::id());

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
            'message' => 'Product removed from cart successfully',
            'data' => new CartResource($cart->fresh()->load('cartItems.product'))
        ]);
    }

    /**
     * Clear cart.
     */
    public function clear(): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart(Auth::id());
        $this->cartService->clearCart($cart);

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully'
        ]);
    }

    /**
     * Apply coupon to cart.
     */
    public function applyCoupon(ApplyCouponRequest $request): JsonResponse
    {
        $cart = $this->cartService->getOrCreateCart(Auth::id());

        $result = $this->couponService->applyCoupon(
            $request->code,
            $this->cartService->getCartTotal($cart)
        );

        return response()->json($result);
    }

    /**
     * Set shipping method for cart.
     */
    public function setShipping(Request $request): JsonResponse
    {
        $request->validate([
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ]);

        $cart = $this->cartService->getOrCreateCart(Auth::id());

        // Store selected shipping method in session
        session(['selected_shipping_method' => $request->shipping_method_id]);

        return response()->json([
            'success' => true,
            'message' => 'Shipping method updated successfully',
            'data' => new CartResource($cart->fresh()->load('cartItems.product'))
        ]);
    }
}
