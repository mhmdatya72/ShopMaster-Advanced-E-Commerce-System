<?php

namespace App\Services\Contracts;

use App\Models\Coupon;
use Illuminate\Pagination\LengthAwarePaginator;

interface CouponServiceInterface
{
    /**
     * Get all coupons with pagination.
     */
    public function getAllCoupons(int $perPage = 15, ?bool $active = null): LengthAwarePaginator;

    /**
     * Get coupon by ID.
     */
    public function getCouponById(string $id): ?Coupon;

    /**
     * Create a new coupon.
     */
    public function createCoupon(array $data): Coupon;

    /**
     * Update a coupon.
     */
    public function updateCoupon(string $id, array $data): Coupon;

    /**
     * Delete a coupon.
     */
    public function deleteCoupon(string $id): bool;

    /**
     * Validate coupon code.
     */
    public function validateCoupon(string $code, float $orderValue): ?Coupon;

    /**
     * Validate and apply coupon to order.
     */
    public function applyCoupon(string $code, float $orderValue, ?int $userId = null): array;

    /**
     * Get coupon by code.
     */
    public function getCouponByCode(string $code): ?Coupon;

    /**
     * Calculate discount amount.
     */
    public function calculateDiscount(Coupon $coupon, float $orderValue): float;

    /**
     * Check if coupon is valid.
     */
    public function isCouponValid(Coupon $coupon): bool;

    /**
     * Check if coupon can be applied to order value.
     */
    public function canApplyCoupon(Coupon $coupon, float $orderValue): bool;

    /**
     * Check if user has already used this coupon.
     */
    public function hasUserUsedCoupon(Coupon $coupon, int $userId): bool;
}
