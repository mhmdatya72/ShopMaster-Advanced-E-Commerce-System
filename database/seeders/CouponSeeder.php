<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'discount_type' => 'percent',
                'discount_value' => 10,
                'min_order_value' => 50.00,
                'max_uses' => 100,
                'expires_at' => Carbon::now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'code' => 'SAVE20',
                'discount_type' => 'percent',
                'discount_value' => 20,
                'min_order_value' => 100.00,
                'max_uses' => 50,
                'expires_at' => Carbon::now()->addMonths(2),
                'is_active' => true,
            ],
            [
                'code' => 'FREESHIP',
                'discount_type' => 'fixed',
                'discount_value' => 15.00,
                'min_order_value' => 75.00,
                'max_uses' => 200,
                'expires_at' => Carbon::now()->addMonth(),
                'is_active' => true,
            ],
            [
                'code' => 'NEWUSER',
                'discount_type' => 'percent',
                'discount_value' => 15,
                'min_order_value' => 25.00,
                'max_uses' => 500,
                'expires_at' => Carbon::now()->addYear(),
                'is_active' => true,
            ],
            [
                'code' => 'BIGSAVE',
                'discount_type' => 'fixed',
                'discount_value' => 50.00,
                'min_order_value' => 200.00,
                'max_uses' => 25,
                'expires_at' => Carbon::now()->addWeeks(2),
                'is_active' => true,
            ],
            [
                'code' => 'EXPIRED',
                'discount_type' => 'percent',
                'discount_value' => 30,
                'min_order_value' => 50.00,
                'max_uses' => 10,
                'expires_at' => Carbon::now()->subDays(5), // Expired
                'is_active' => false,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
