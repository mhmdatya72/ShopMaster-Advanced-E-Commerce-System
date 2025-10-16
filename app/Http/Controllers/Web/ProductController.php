<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ProductServiceInterface;
use App\Models\Category;
use Illuminate\Http\Request;

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
        
        $categories = Category::active()->get();
        
        return view('products.index', compact('products', 'categories', 'query', 'categoryId'));
    }

    /**
     * Display the specified product.
     */
    public function show(string $slug)
    {
        $product = $this->productService->getProductBySlug($slug);
        
        if (!$product) {
            abort(404);
        }
        
        $relatedProducts = $this->productService->getProductsByCategory($product->category_id, 4);
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
