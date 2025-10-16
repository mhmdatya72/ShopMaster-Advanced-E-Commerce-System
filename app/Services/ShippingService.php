<?php

namespace App\Services;

use App\Models\ShippingMethod;
use App\Services\Contracts\ShippingServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ShippingService implements ShippingServiceInterface
{
    /**
     * Get all active shipping methods.
     */
    public function getActiveShippingMethods(): Collection
    {
        return ShippingMethod::active()->orderBy('cost')->get();
    }

    /**
     * Get shipping method by ID.
     */
    public function getShippingMethodById(int $id): ?ShippingMethod
    {
        return ShippingMethod::find($id);
    }

    /**
     * Calculate shipping cost.
     */
    public function calculateShippingCost(ShippingMethod $shippingMethod, float $orderValue = 0): float
    {
        // Free shipping logic can be implemented here
        // For example, free shipping for orders over $100
        if ($orderValue >= 100) {
            return 0;
        }

        return $shippingMethod->cost;
    }

    /**
     * Validate shipping method.
     */
    public function validateShippingMethod(int $id): bool
    {
        $shippingMethod = $this->getShippingMethodById($id);
        
        return $shippingMethod && $shippingMethod->is_active;
    }
}
