<?php

namespace App\Services\Contracts;

use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Collection;

interface ShippingServiceInterface
{
    /**
     * Get all active shipping methods.
     */
    public function getActiveShippingMethods(): Collection;

    /**
     * Get shipping method by ID.
     */
    public function getShippingMethodById(int $id): ?ShippingMethod;

    /**
     * Calculate shipping cost.
     */
    public function calculateShippingCost(ShippingMethod $shippingMethod, float $orderValue = 0): float;

    /**
     * Validate shipping method.
     */
    public function validateShippingMethod(int $id): bool;
}
