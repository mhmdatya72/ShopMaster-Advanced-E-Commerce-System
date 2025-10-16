<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\Contracts\CartServiceInterface;
use Illuminate\Support\Facades\DB;

class CartService implements CartServiceInterface
{
    /**
     * Get or create cart for user.
     */
    public function getOrCreateCart(?int $userId = null, ?string $sessionId = null): Cart
    {
        $query = Cart::query();

        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }

        $cart = $query->first();

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
            ]);
        }

        return $cart->load('cartItems.product');
    }

    /**
     * Add product to cart.
     */
    public function addToCart(Cart $cart, Product $product, int $quantity = 1): CartItem
    {
        if (!$product->isInStock()) {
            throw new \Exception('Product is out of stock');
        }

        if (!$product->hasStock($quantity)) {
            throw new \Exception('Insufficient stock available');
        }

        $existingItem = $this->getCartItemForProduct($cart, $product);

        if ($existingItem) {
            return $this->updateCartItem($existingItem, $existingItem->quantity + $quantity);
        }

        return CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
            'unit_price' => $product->price,
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function updateCartItem(CartItem $cartItem, int $quantity): CartItem
    {
        if ($quantity <= 0) {
            return $this->removeFromCart($cartItem) ? $cartItem : $cartItem;
        }

        if (!$cartItem->product->hasStock($quantity)) {
            throw new \Exception('Insufficient stock available');
        }

        $cartItem->update(['quantity' => $quantity]);

        return $cartItem->fresh();
    }

    /**
     * Remove item from cart.
     */
    public function removeFromCart(CartItem $cartItem): bool
    {
        return $cartItem->delete();
    }

    /**
     * Clear cart.
     */
    public function clearCart(Cart $cart): bool
    {
        return $cart->cartItems()->delete() >= 0;
    }

    /**
     * Get cart subtotal (before tax/shipping).
     */
    public function getCartSubtotal(Cart $cart): float
    {
        return $cart->cartItems()->sum(DB::raw('quantity * price'));
    }

    /**
     * Get cart total.
     */
    public function getCartTotal(Cart $cart): float
    {
        return $this->getCartSubtotal($cart);
    }

    /**
     * Get cart items count.
     */
    public function getCartItemsCount(Cart $cart): int
    {
        return $cart->cartItems()->sum('quantity');
    }

    /**
     * Check if product is in cart.
     */
    public function isProductInCart(Cart $cart, Product $product): bool
    {
        return $cart->cartItems()->where('product_id', $product->id)->exists();
    }

    /**
     * Get cart item for product.
     */
    public function getCartItemForProduct(Cart $cart, Product $product): ?CartItem
    {
        return $cart->cartItems()->where('product_id', $product->id)->first();
    }
}
