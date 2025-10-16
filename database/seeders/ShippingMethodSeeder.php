<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingMethods = [
            [
                'name' => 'Standard Shipping',
                'description' => 'Regular shipping with tracking',
                'cost' => 9.99,
                'estimated_days' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Express Shipping',
                'description' => 'Fast shipping with priority handling',
                'cost' => 19.99,
                'estimated_days' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Overnight Shipping',
                'description' => 'Next day delivery',
                'cost' => 39.99,
                'estimated_days' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Free Shipping',
                'description' => 'Free shipping on orders over $100',
                'cost' => 0.00,
                'estimated_days' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'International Shipping',
                'description' => 'Worldwide shipping with customs handling',
                'cost' => 49.99,
                'estimated_days' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'Disabled Method',
                'description' => 'This shipping method is disabled',
                'cost' => 5.99,
                'estimated_days' => 3,
                'is_active' => false,
            ],
        ];

        foreach ($shippingMethods as $method) {
            ShippingMethod::create($method);
        }
    }
}
