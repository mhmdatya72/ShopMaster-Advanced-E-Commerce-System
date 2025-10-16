<?php

namespace App\Services\Contracts;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    /**
     * Get all products with pagination.
     */
    public function getAllProducts(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get products by category.
     */
    public function getProductsByCategory(int $categoryId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Search products.
     */
    public function searchProducts(string $query, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get featured products.
     */
    public function getFeaturedProducts(int $limit = 8): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get product by ID.
     */
    public function getProductById(int $id): ?Product;

    /**
     * Get product by slug.
     */
    public function getProductBySlug(string $slug): ?Product;

    /**
     * Create a new product.
     */
    public function createProduct(array $data): Product;

    /**
     * Update a product.
     */
    public function updateProduct(int $id, array $data): Product;

    /**
     * Delete a product.
     */
    public function deleteProduct(int $id): bool;

    /**
     * Update product stock.
     */
    public function updateStock(int $id, int $quantity): Product;
}
