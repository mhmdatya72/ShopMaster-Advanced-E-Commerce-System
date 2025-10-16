<?php

namespace App\Services\Contracts;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

interface CartServiceInterface
{
    /**
     * Get or create cart for user.
     */
    public function getOrCreateCart(?int $userId = null, ?string $sessionId = null): Cart;

    /**
     * Add product to cart.
     */
    public function addToCart(Cart $cart, Product $product, int $quantity = 1): CartItem;

    /**
     * Update cart item quantity.
     */
    public function updateCartItem(CartItem $cartItem, int $quantity): CartItem;

    /**
     * Remove item from cart.
     */
    public function removeFromCart(CartItem $cartItem): bool;

    /**
     * Clear cart.
     */
    public function clearCart(Cart $cart): bool;

    /**
     * Get cart subtotal (before tax/shipping).
     */
    public function getCartSubtotal(Cart $cart): float;

    /**
     * Get cart total.
     */
    public function getCartTotal(Cart $cart): float;

    /**
     * Get cart items count.
     */
    public function getCartItemsCount(Cart $cart): int;

    /**
     * Check if product is in cart.
     */
    public function isProductInCart(Cart $cart, Product $product): bool;

    /**
     * Get cart item for product.
     */
    public function getCartItemForProduct(Cart $cart, Product $product): ?CartItem;
}
