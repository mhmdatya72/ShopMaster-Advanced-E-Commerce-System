<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private ProductServiceInterface $productService
    ) {}

    /**
     * Display the homepage.
     */
    public function index()
    {
        $featuredProducts = $this->productService->getFeaturedProducts(8);
        
        return view('home', compact('featuredProducts'));
    }
}
