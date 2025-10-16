<?php

namespace App\Services;

use App\Models\ShippingMethod;
use App\Services\Contracts\ShippingMethodServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ShippingMethodService implements ShippingMethodServiceInterface
{
    /**
     * Get all shipping methods with pagination.
     */
    public function getAllShippingMethods(int $perPage = 15, ?bool $active = null): LengthAwarePaginator
    {
        $query = ShippingMethod::query();

        if ($active !== null) {
            $query->where('is_active', $active);
        }

        return $query->orderBy('name')->paginate($perPage);
    }

    /**
     * Get active shipping methods.
     */
    public function getActiveShippingMethods(): Collection
    {
        return ShippingMethod::active()->orderBy('name')->get();
    }

    /**
     * Get shipping method by ID.
     */
    public function getShippingMethodById(string $id): ?ShippingMethod
    {
        return ShippingMethod::find($id);
    }

    /**
     * Create a new shipping method.
     */
    public function createShippingMethod(array $data): ShippingMethod
    {
        return ShippingMethod::create($data);
    }

    /**
     * Update a shipping method.
     */
    public function updateShippingMethod(string $id, array $data): ShippingMethod
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->update($data);
        return $shippingMethod->fresh();
    }

    /**
     * Delete a shipping method.
     */
    public function deleteShippingMethod(string $id): bool
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        
        // Check if shipping method has orders
        if ($shippingMethod->orders()->count() > 0) {
            throw new \Exception('Cannot delete shipping method that has orders');
        }

        return $shippingMethod->delete();
    }
}
