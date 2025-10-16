<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\Contracts\ProductServiceInterface;

class ProductController extends Controller
{
    public function __construct(
        private ProductServiceInterface $productService
    ) {}

    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = $request->get('search');
        $categoryId = $request->get('category');

        if ($query) {
            $products = $this->productService->searchProducts($query);
        } elseif ($categoryId) {
            $products = $this->productService->getProductsByCategory($categoryId);
        } else {
            $products = $this->productService->getAllProducts();
        }

        return view('admin.products.index', compact('products', 'query', 'categoryId'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product.
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->createProduct($request->validated());

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        if (!$product) {
            abort(404);
        }

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $categories = Category::active()->get();

        if (!$product) {
            abort(404);
        }

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $this->productService->updateProduct($id, $request->validated());

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
