<?php

namespace App\Providers;

use App\Services\Contracts\ProductServiceInterface;
use App\Services\Contracts\CartServiceInterface;
use App\Services\Contracts\CouponServiceInterface;
use App\Services\Contracts\ShippingServiceInterface;
use App\Services\Contracts\ShippingMethodServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\AdminServiceInterface;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\ProductService;
use App\Services\CartService;
use App\Services\CouponService;
use App\Services\ShippingService;
use App\Services\ShippingMethodService;
use App\Services\OrderService;
use App\Services\AdminService;
use App\Services\CategoryService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind service interfaces to their implementations
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(CouponServiceInterface::class, CouponService::class);
        $this->app->bind(ShippingServiceInterface::class, ShippingService::class);
        $this->app->bind(ShippingMethodServiceInterface::class, ShippingMethodService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
