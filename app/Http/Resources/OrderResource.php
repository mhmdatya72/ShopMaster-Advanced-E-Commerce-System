<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'subtotal' => $this->subtotal,
            'formatted_subtotal' => '$' . number_format($this->subtotal, 2),
            'shipping_cost' => $this->shipping_cost,
            'formatted_shipping_cost' => '$' . number_format($this->shipping_cost, 2),
            'discount_amount' => $this->discount_amount,
            'formatted_discount_amount' => '$' . number_format($this->discount_amount, 2),
            'total_amount' => $this->total_amount,
            'formatted_total_amount' => '$' . number_format($this->total_amount, 2),
            'status' => $this->status,
            'status_label' => ucfirst($this->status),
            'shipping_address' => $this->shipping_address,
            'billing_address' => $this->billing_address,
            'notes' => $this->notes,
            'coupon' => new CouponResource($this->whenLoaded('coupon')),
            'shipping_method' => new ShippingMethodResource($this->whenLoaded('shippingMethod')),
            'user' => new UserResource($this->whenLoaded('user')),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
