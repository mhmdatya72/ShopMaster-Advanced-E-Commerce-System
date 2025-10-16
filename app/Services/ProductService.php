<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductServiceInterface
{
    /**
     * Get all products with pagination.
     */
    public function getAllProducts(int $perPage = 15): LengthAwarePaginator
    {
        return Product::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get products by category.
     */
    public function getProductsByCategory(int $categoryId, int $perPage = 15): LengthAwarePaginator
    {
        return Product::with('category')
            ->where('category_id', $categoryId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Search products.
     */
    public function searchProducts(string $query, int $perPage = 15): LengthAwarePaginator
    {
        return Product::with('category')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get featured products.
     */
    public function getFeaturedProducts(int $limit = 8): Collection
    {
        return Product::with('category')
            ->active()
            ->inStock()
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get product by ID.
     */
    public function getProductById(int $id): ?Product
    {
        return Product::with('category')->find($id);
    }

    /**
     * Get product by slug.
     */
    public function getProductBySlug(string $slug): ?Product
    {
        return Product::with('category')
            ->where('slug', $slug)
            ->active()
            ->first();
    }

    /**
     * Create a new product.
     */
    public function createProduct(array $data): Product
    {
        // Handle image upload
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('products', 'public');
        }

        return Product::create($data);
    }

    /**
     * Update a product.
     */
    public function updateProduct(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);

        // Handle image upload
        if (isset($data['image']) && $data['image']) {
            // Delete old image if exists
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $data['image']->store('products', 'public');
        }

        $product->update($data);

        return $product->fresh();
    }

    /**
     * Delete a product.
     */
    public function deleteProduct(int $id): bool
    {
        $product = Product::findOrFail($id);

        return $product->delete();
    }

    /**
     * Update product stock.
     */
    public function updateStock(int $id, int $quantity): Product
    {
        $product = Product::findOrFail($id);
        $product->update(['stock' => $quantity]);

        return $product->fresh();
    }
}
