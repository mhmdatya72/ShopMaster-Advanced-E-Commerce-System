<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'session_id' => $this->session_id,
            'items' => CartItemResource::collection($this->whenLoaded('cartItems')),
            'total_items' => $this->cartItems->sum('quantity'),
            'subtotal' => $this->subtotal,
            'formatted_subtotal' => '$' . number_format($this->subtotal, 2),
            'shipping_cost' => $this->shipping_cost,
            'formatted_shipping_cost' => '$' . number_format($this->shipping_cost, 2),
            'discount_amount' => $this->discount_amount,
            'formatted_discount_amount' => '$' . number_format($this->discount_amount, 2),
            'total' => $this->total,
            'formatted_total' => '$' . number_format($this->total, 2),
            'coupon' => new CouponResource($this->whenLoaded('coupon')),
            'shipping_method' => new ShippingMethodResource($this->whenLoaded('shippingMethod')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
