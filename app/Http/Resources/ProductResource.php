<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'formatted_price' => '$' . number_format($this->price, 2),
            'stock' => $this->stock,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'images' => $this->images ? collect($this->images)->map(fn($image) => asset('storage/' . $image)) : [],
            'weight' => $this->weight,
            'attributes' => $this->attributes,
            'is_active' => $this->is_active,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
