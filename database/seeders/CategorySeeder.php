<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and gadgets',
                'is_active' => true,
            ],
            [
                'name' => 'Clothing',
                'description' => 'Fashion and apparel',
                'is_active' => true,
            ],
            [
                'name' => 'Home & Garden',
                'description' => 'Home improvement and garden supplies',
                'is_active' => true,
            ],
            [
                'name' => 'Sports & Outdoors',
                'description' => 'Sports equipment and outdoor gear',
                'is_active' => true,
            ],
            [
                'name' => 'Books',
                'description' => 'Books and educational materials',
                'is_active' => true,
            ],
            [
                'name' => 'Toys & Games',
                'description' => 'Toys and gaming accessories',
                'is_active' => true,
            ],
            [
                'name' => 'Health & Beauty',
                'description' => 'Health and beauty products',
                'is_active' => true,
            ],
            [
                'name' => 'Automotive',
                'description' => 'Car parts and automotive accessories',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
