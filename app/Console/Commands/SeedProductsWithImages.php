<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SeedProductsWithImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:seed-with-images {--fresh : Clear existing products first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed products with real images from Unsplash';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Starting product seeding with images...');

        // Clear existing products if --fresh flag is used
        if ($this->option('fresh')) {
            $this->info(' Clearing existing products...');

            // Disable foreign key checks temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Product::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Clear product images directory
            if (Storage::disk('public')->exists('products')) {
                Storage::disk('public')->deleteDirectory('products');
            }
        }

        // Create products directory if it doesn't exist
        if (!Storage::disk('public')->exists('products')) {
            Storage::disk('public')->makeDirectory('products');
        }

        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->error(' No categories found. Please run category seeder first.');
            return 1;
        }

        $this->info(' Creating products with images...');

        $products = [
            // Electronics
            [
                'name' => 'iPhone 15 Pro Max',
                'description' => 'The most advanced iPhone ever with titanium design, A17 Pro chip, and revolutionary camera system with 5x Telephoto zoom.',
                'price' => 1199.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'weight' => 0.221,
                'attributes' => ['color' => 'Natural Titanium', 'storage' => '256GB', 'display' => '6.7"'],
                'image' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'MacBook Pro 16" M3 Max',
                'description' => 'Supercharged for pros with M3 Max chip, stunning Liquid Retina XDR display, and all-day battery life.',
                'price' => 2499.99,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'weight' => 2.16,
                'attributes' => ['color' => 'Space Black', 'storage' => '1TB', 'memory' => '32GB'],
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'description' => 'Industry-leading noise canceling with Dual Noise Sensor technology and 30-hour battery life.',
                'price' => 399.99,
                'stock' => 50,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'weight' => 0.25,
                'attributes' => ['color' => 'Black', 'battery_life' => '30 hours', 'noise_canceling' => 'Yes'],
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'description' => 'The ultimate Galaxy with S Pen, 200MP camera, and AI-powered features for professional photography.',
                'price' => 1299.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'weight' => 0.232,
                'attributes' => ['color' => 'Titanium Black', 'storage' => '512GB', 'display' => '6.8"'],
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'iPad Pro 12.9" M2',
                'description' => 'The most advanced iPad with M2 chip, Liquid Retina XDR display, and Apple Pencil support.',
                'price' => 1099.99,
                'stock' => 40,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'weight' => 0.682,
                'attributes' => ['color' => 'Space Gray', 'storage' => '256GB', 'display' => '12.9"'],
                'image' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=800&h=600&fit=crop&crop=center',
            ],

            // Clothing
            [
                'name' => 'Premium Cotton T-Shirt',
                'description' => 'Ultra-soft 100% organic cotton t-shirt with modern fit and sustainable materials.',
                'price' => 29.99,
                'stock' => 150,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'weight' => 0.2,
                'attributes' => ['size' => 'M', 'color' => 'White', 'material' => 'Organic Cotton'],
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Designer Denim Jeans',
                'description' => 'Premium slim-fit denim jeans with stretch technology and vintage wash finish.',
                'price' => 129.99,
                'stock' => 80,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'weight' => 0.6,
                'attributes' => ['size' => '32', 'color' => 'Dark Blue', 'fit' => 'Slim'],
                'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Luxury Wool Sweater',
                'description' => 'Hand-knitted merino wool sweater with classic crew neck and soft texture.',
                'price' => 199.99,
                'stock' => 45,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'weight' => 0.4,
                'attributes' => ['size' => 'L', 'color' => 'Navy', 'material' => 'Merino Wool'],
                'image' => 'https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Athletic Performance Hoodie',
                'description' => 'Moisture-wicking athletic hoodie with zip-up design and comfortable fit.',
                'price' => 79.99,
                'stock' => 90,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'weight' => 0.5,
                'attributes' => ['size' => 'XL', 'color' => 'Black', 'material' => 'Polyester'],
                'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&h=600&fit=crop&crop=center',
            ],

            // Home & Garden
            [
                'name' => 'Smart Coffee Maker',
                'description' => 'WiFi-enabled programmable coffee maker with app control and thermal carafe.',
                'price' => 199.99,
                'stock' => 35,
                'category_id' => $categories->where('name', 'Home & Garden')->first()->id,
                'weight' => 3.2,
                'attributes' => ['capacity' => '12 cups', 'color' => 'Stainless Steel', 'smart' => 'Yes'],
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Premium Garden Hose Set',
                'description' => '50ft expandable garden hose with 8-pattern spray nozzle and storage bag.',
                'price' => 49.99,
                'stock' => 60,
                'category_id' => $categories->where('name', 'Home & Garden')->first()->id,
                'weight' => 1.5,
                'attributes' => ['length' => '50ft', 'material' => 'Latex', 'patterns' => '8'],
                'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Smart Air Purifier',
                'description' => 'HEPA air purifier with smart sensors and mobile app control for cleaner air.',
                'price' => 299.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Home & Garden')->first()->id,
                'weight' => 4.5,
                'attributes' => ['coverage' => '500 sq ft', 'filters' => 'HEPA', 'smart' => 'Yes'],
                'image' => 'https://images.unsplash.com/photo-1581578731548-c6a0c3f2f1c6?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Indoor Plant Collection',
                'description' => 'Set of 3 low-maintenance indoor plants perfect for home decoration.',
                'price' => 89.99,
                'stock' => 40,
                'category_id' => $categories->where('name', 'Home & Garden')->first()->id,
                'weight' => 2.0,
                'attributes' => ['plants' => '3', 'pots' => 'Included', 'care_level' => 'Easy'],
                'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800&h=600&fit=crop&crop=center',
            ],

            // Sports & Outdoors
            [
                'name' => 'Premium Yoga Mat',
                'description' => 'Non-slip eco-friendly yoga mat with carrying strap and alignment lines.',
                'price' => 79.99,
                'stock' => 100,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
                'weight' => 1.2,
                'attributes' => ['thickness' => '6mm', 'color' => 'Purple', 'material' => 'Eco-friendly'],
                'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Professional Running Shoes',
                'description' => 'Lightweight running shoes with responsive cushioning and breathable mesh upper.',
                'price' => 179.99,
                'stock' => 70,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
                'weight' => 0.9,
                'attributes' => ['size' => '10', 'color' => 'White/Blue', 'type' => 'Running'],
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Fitness Resistance Bands Set',
                'description' => 'Complete set of resistance bands with door anchor and exercise guide.',
                'price' => 39.99,
                'stock' => 120,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
                'weight' => 0.8,
                'attributes' => ['bands' => '5', 'resistance' => '10-50 lbs', 'accessories' => 'Door anchor'],
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Outdoor Camping Tent',
                'description' => '4-person waterproof tent with rainfly and easy setup design.',
                'price' => 299.99,
                'stock' => 20,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
                'weight' => 8.5,
                'attributes' => ['capacity' => '4 people', 'waterproof' => 'Yes', 'setup' => 'Easy'],
                'image' => 'https://images.unsplash.com/photo-1487730116645-74489c95b41b?w=800&h=600&fit=crop&crop=center',
            ],

            // Books
            [
                'name' => 'The Great Gatsby - Special Edition',
                'description' => 'Classic American novel by F. Scott Fitzgerald with beautiful hardcover design.',
                'price' => 24.99,
                'stock' => 80,
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'weight' => 0.4,
                'attributes' => ['format' => 'Hardcover', 'pages' => '180', 'edition' => 'Special'],
                'image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Complete Web Development Guide',
                'description' => 'Comprehensive guide to modern web development with HTML, CSS, JavaScript, and frameworks.',
                'price' => 79.99,
                'stock' => 50,
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'weight' => 1.5,
                'attributes' => ['format' => 'Hardcover', 'pages' => '800', 'level' => 'Beginner to Advanced'],
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Mindfulness and Meditation',
                'description' => 'A practical guide to mindfulness, meditation, and finding inner peace.',
                'price' => 34.99,
                'stock' => 65,
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'weight' => 0.6,
                'attributes' => ['format' => 'Paperback', 'pages' => '320', 'category' => 'Self-help'],
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop&crop=center',
            ],
        ];

        $bar = $this->output->createProgressBar(count($products));
        $bar->start();

        $successCount = 0;
        $errorCount = 0;

        foreach ($products as $productData) {
            try {
                // Download and store the image
                $imageUrl = $productData['image'];
                unset($productData['image']);

                $product = Product::create($productData);

                // Download image and store it
                $imageContent = file_get_contents($imageUrl);
                $imageName = 'product_' . $product->id . '_' . time() . '.jpg';
                $imagePath = 'products/' . $imageName;

                Storage::disk('public')->put($imagePath, $imageContent);
                $product->update(['image' => $imagePath]);

                $successCount++;
            } catch (\Exception $e) {
                $errorCount++;
                $this->warn("Failed to create product: " . $e->getMessage());
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        // Create additional random products with images
        $this->info(' Creating additional random products...');

        $additionalProducts = [
            [
                'name' => 'Wireless Bluetooth Speaker',
                'description' => 'Portable speaker with 360-degree sound and waterproof design.',
                'price' => 89.99,
                'stock' => 60,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'weight' => 0.6,
                'attributes' => ['battery' => '12 hours', 'waterproof' => 'IPX7', 'color' => 'Black'],
                'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Smart Watch Series 9',
                'description' => 'Advanced smartwatch with health monitoring and GPS tracking.',
                'price' => 399.99,
                'stock' => 45,
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'weight' => 0.38,
                'attributes' => ['display' => 'Always-on', 'battery' => '18 hours', 'water_resistant' => 'Yes'],
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Vintage Leather Jacket',
                'description' => 'Classic vintage-style leather jacket with modern fit and premium materials.',
                'price' => 299.99,
                'stock' => 25,
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'weight' => 1.2,
                'attributes' => ['size' => 'L', 'color' => 'Brown', 'material' => 'Genuine Leather'],
                'image' => 'https://images.unsplash.com/photo-1551028719-001c67e0b5e0?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Kitchen Knife Set',
                'description' => 'Professional 8-piece knife set with wooden block and sharpening steel.',
                'price' => 149.99,
                'stock' => 30,
                'category_id' => $categories->where('name', 'Home & Garden')->first()->id,
                'weight' => 2.8,
                'attributes' => ['pieces' => '8', 'material' => 'Stainless Steel', 'block' => 'Wooden'],
                'image' => 'https://images.unsplash.com/photo-1583394838336-acd977736f90?w=800&h=600&fit=crop&crop=center',
            ],
            [
                'name' => 'Mountain Bike',
                'description' => 'Full-suspension mountain bike with 27.5" wheels and 21-speed drivetrain.',
                'price' => 899.99,
                'stock' => 15,
                'category_id' => $categories->where('name', 'Sports & Outdoors')->first()->id,
                'weight' => 14.5,
                'attributes' => ['wheels' => '27.5"', 'speeds' => '21', 'suspension' => 'Full'],
                'image' => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=800&h=600&fit=crop&crop=center',
            ],
        ];

        $additionalBar = $this->output->createProgressBar(count($additionalProducts));
        $additionalBar->start();

        foreach ($additionalProducts as $productData) {
            try {
                $imageUrl = $productData['image'];
                unset($productData['image']);

                $product = Product::create($productData);

                $imageContent = file_get_contents($imageUrl);
                $imageName = 'product_' . $product->id . '_' . time() . '.jpg';
                $imagePath = 'products/' . $imageName;

                Storage::disk('public')->put($imagePath, $imageContent);
                $product->update(['image' => $imagePath]);

                $successCount++;
            } catch (\Exception $e) {
                $errorCount++;
                $this->warn("Failed to create additional product: " . $e->getMessage());
            }

            $additionalBar->advance();
        }

        $additionalBar->finish();
        $this->newLine();

        // Summary
        $this->info(" Product seeding completed!");
        $this->info("Successfully created: {$successCount} products");
        if ($errorCount > 0) {
            $this->warn("  Failed to create: {$errorCount} products");
        }
        $this->info(" All products include high-quality images from Unsplash");
        $this->info("Images stored in: storage/app/public/products/");

        return 0;
    }
}
