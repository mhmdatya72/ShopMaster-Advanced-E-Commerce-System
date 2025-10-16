<?php

namespace App\Services;

use App\Models\Coupon;
use App\Services\Contracts\CouponServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CouponService implements CouponServiceInterface
{
    /**
     * Get all coupons with pagination.
     */
    public function getAllCoupons(int $perPage = 15, ?bool $active = null): LengthAwarePaginator
    {
        $query = Coupon::query();

        if ($active !== null) {
            $query->where('is_active', $active);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get coupon by ID.
     */
    public function getCouponById(string $id): ?Coupon
    {
        return Coupon::find($id);
    }

    /**
     * Create a new coupon.
     */
    public function createCoupon(array $data): Coupon
    {
        return Coupon::create($data);
    }

    /**
     * Update a coupon.
     */
    public function updateCoupon(string $id, array $data): Coupon
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($data);
        return $coupon->fresh();
    }

    /**
     * Delete a coupon.
     */
    public function deleteCoupon(string $id): bool
    {
        $coupon = Coupon::findOrFail($id);
        return $coupon->delete();
    }

    /**
     * Validate coupon code.
     */
    public function validateCoupon(string $code, float $orderValue): ?Coupon
    {
        $coupon = $this->getCouponByCode($code);

        if (!$coupon || !$coupon->canBeAppliedTo($orderValue)) {
            return null;
        }

        return $coupon;
    }
    /**
     * Validate and apply coupon to order.
     */
    public function applyCoupon(string $code, float $orderValue, ?int $userId = null): array
    {
        $coupon = $this->getCouponByCode($code);

        if (!$coupon) {
            return [
                'success' => false,
                'message' => 'Invalid coupon code',
                'discount' => 0,
            ];
        }

        if (!$this->isCouponValid($coupon)) {
            return [
                'success' => false,
                'message' => 'Coupon is no longer valid',
                'discount' => 0,
            ];
        }

        if (!$this->canApplyCoupon($coupon, $orderValue)) {
            return [
                'success' => false,
                'message' => 'Coupon cannot be applied to this order value',
                'discount' => 0,
            ];
        }

        // Check if coupon has already been used by this user
        if ($userId && $this->hasUserUsedCoupon($coupon, $userId)) {
            return [
                'success' => false,
                'message' => 'You have already used this coupon code',
                'discount' => 0,
            ];
        }

        $discount = $this->calculateDiscount($coupon, $orderValue);

        return [
            'success' => true,
            'message' => 'Coupon applied successfully',
            'discount' => $discount,
            'coupon' => $coupon,
        ];
    }

    /**
     * Get coupon by code.
     */
    public function getCouponByCode(string $code): ?Coupon
    {
        return Coupon::where('code', $code)->first();
    }

    /**
     * Calculate discount amount.
     */
    public function calculateDiscount(Coupon $coupon, float $orderValue): float
    {
        if ($coupon->discount_type === 'percent') {
            return ($orderValue * $coupon->discount_value) / 100;
        }

        return min($coupon->discount_value, $orderValue);
    }

    /**
     * Check if coupon is valid.
     */
    public function isCouponValid(Coupon $coupon): bool
    {
        if (!$coupon->is_active) {
            return false;
        }

        if ($coupon->expires_at && $coupon->expires_at->isPast()) {
            return false;
        }

        if ($coupon->max_uses && $coupon->used_count >= $coupon->max_uses) {
            return false;
        }

        return true;
    }

    /**
     * Check if coupon can be applied to order value.
     */
    public function canApplyCoupon(Coupon $coupon, float $orderValue): bool
    {
        if (!$this->isCouponValid($coupon)) {
            return false;
        }

        if ($coupon->min_order_value && $orderValue < $coupon->min_order_value) {
            return false;
        }

        return true;
    }

    /**
     * Check if user has already used this coupon.
     */
    public function hasUserUsedCoupon(Coupon $coupon, int $userId): bool
    {
        return \App\Models\Order::where('user_id', $userId)
            ->where('coupon_id', $coupon->id)
            ->exists();
    }
}
