<?php

namespace App\Services;

use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryService implements CategoryServiceInterface
{
    /**
     * Get all categories.
     */
    public function getAllCategories(): Collection
    {
        return Category::orderBy('name')->get();
    }

    /**
     * Get active categories.
     */
    public function getActiveCategories(): Collection
    {
        return Category::active()->orderBy('name')->get();
    }

    /**
     * Get category by ID.
     */
    public function getCategoryById(string $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Get category by slug.
     */
    public function getCategoryBySlug(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    /**
     * Create a new category.
     */
    public function createCategory(array $data): Category
    {
        // Generate slug if not provided
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return Category::create($data);
    }

    /**
     * Update a category.
     */
    public function updateCategory(string $id, array $data): Category
    {
        $category = Category::findOrFail($id);

        // Generate slug if name is being updated and slug is not provided
        if (isset($data['name']) && (!isset($data['slug']) || empty($data['slug']))) {
            $data['slug'] = Str::slug($data['name']);
        }

        $category->update($data);

        return $category->fresh();
    }

    /**
     * Delete a category.
     */
    public function deleteCategory(string $id): bool
    {
        $category = Category::findOrFail($id);

        // Check if category has products
        if ($category->products()->count() > 0) {
            throw new \Exception('Cannot delete category that has products');
        }

        return $category->delete();
    }
}
