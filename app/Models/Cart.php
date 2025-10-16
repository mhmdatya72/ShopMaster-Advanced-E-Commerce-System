<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'session_id',
    ];

    /**
     * Get the user that owns the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cart items for the cart.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get the products for the cart through cart items.
     */
    public function products()
    {
        return $this->hasManyThrough(Product::class, CartItem::class);
    }

    /**
     * Get total items count in cart.
     */
    public function getTotalItemsAttribute(): int
    {
        return $this->cartItems()->sum('quantity');
    }

    /**
     * Get subtotal of cart.
     */
    public function getSubtotalAttribute(): float
    {
        return $this->cartItems()->sum(\DB::raw('quantity * price'));
    }

    /**
     * Get formatted subtotal.
     */
    public function getFormattedSubtotalAttribute(): string
    {
        return '$' . number_format($this->subtotal, 2);
    }

    /**
     * Check if cart is empty.
     */
    public function isEmpty(): bool
    {
        return $this->cartItems()->count() === 0;
    }

    /**
     * Clear all items from cart.
     */
    public function clear(): void
    {
        $this->cartItems()->delete();
    }
}
