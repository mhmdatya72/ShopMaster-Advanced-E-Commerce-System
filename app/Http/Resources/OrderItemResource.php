<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'quantity' => $this->quantity,
            'price' => $this->price,
            'formatted_price' => '$' . number_format($this->price, 2),
            'total' => $this->quantity * $this->price,
            'formatted_total' => '$' . number_format($this->quantity * $this->price, 2),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
