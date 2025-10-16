<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'code' => $this->code,
            'discount_type' => $this->discount_type,
            'discount_value' => $this->discount_value,
            'formatted_discount' => $this->discount_type === 'percent'
                ? $this->discount_value . '%'
                : '$' . number_format($this->discount_value, 2),
            'min_order_value' => $this->min_order_value,
            'formatted_min_order' => $this->min_order_value ? '$' . number_format($this->min_order_value, 2) : null,
            'max_uses' => $this->max_uses,
            'used_count' => $this->used_count,
            'remaining_uses' => $this->max_uses ? $this->max_uses - $this->used_count : null,
            'expires_at' => $this->expires_at,
            'is_expired' => $this->expires_at ? $this->expires_at->isPast() : false,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
