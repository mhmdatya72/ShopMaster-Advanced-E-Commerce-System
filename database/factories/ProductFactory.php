<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraphs(3, true),
            'price' => fake()->randomFloat(2, 10, 1000),
            'stock' => fake()->numberBetween(0, 100),
            'category_id' => Category::factory(),
            'is_active' => fake()->boolean(90), // 90% chance of being active
            'weight' => fake()->randomFloat(2, 0.1, 10),
            'attributes' => [
                'color' => fake()->colorName(),
                'size' => fake()->randomElement(['S', 'M', 'L', 'XL']),
                'material' => fake()->randomElement(['Cotton', 'Polyester', 'Wool', 'Leather']),
            ],
        ];
    }
}
