<?php

namespace App\Services\Contracts;

use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ShippingMethodServiceInterface
{
    /**
     * Get all shipping methods with pagination.
     */
    public function getAllShippingMethods(int $perPage = 15, ?bool $active = null): LengthAwarePaginator;

    /**
     * Get active shipping methods.
     */
    public function getActiveShippingMethods(): Collection;

    /**
     * Get shipping method by ID.
     */
    public function getShippingMethodById(string $id): ?ShippingMethod;

    /**
     * Create a new shipping method.
     */
    public function createShippingMethod(array $data): ShippingMethod;

    /**
     * Update a shipping method.
     */
    public function updateShippingMethod(string $id, array $data): ShippingMethod;

    /**
     * Delete a shipping method.
     */
    public function deleteShippingMethod(string $id): bool;
}
