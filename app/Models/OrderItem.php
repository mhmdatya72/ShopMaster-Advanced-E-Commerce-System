<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that owns the order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get total price for this order item.
     */
    public function getTotalAttribute(): float
    {
        return $this->quantity * $this->price;
    }

    /**
     * Get formatted total.
     */
    public function getFormattedTotalAttribute(): string
    {
        return '$' . number_format($this->total, 2);
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }
}
