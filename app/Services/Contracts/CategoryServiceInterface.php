<?php

namespace App\Services\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    /**
     * Get all categories.
     */
    public function getAllCategories(): Collection;

    /**
     * Get active categories.
     */
    public function getActiveCategories(): Collection;

    /**
     * Get category by ID.
     */
    public function getCategoryById(string $id): ?Category;

    /**
     * Get category by slug.
     */
    public function getCategoryBySlug(string $slug): ?Category;

    /**
     * Create a new category.
     */
    public function createCategory(array $data): Category;

    /**
     * Update a category.
     */
    public function updateCategory(string $id, array $data): Category;

    /**
     * Delete a category.
     */
    public function deleteCategory(string $id): bool;
}
