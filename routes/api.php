<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AnalyticsController;
use App\Http\Controllers\Api\ShippingMethodController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public API routes with rate limiting
Route::prefix('auth')->middleware(['throttle:5,1'])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Public products route (no auth required)
Route::get('/products', [ProductController::class, 'index']);

// Protected API routes
Route::middleware('auth:api')->group(function () {
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
    });

    // Cart routes with rate limiting
    Route::prefix('cart')->middleware(['throttle:60,1'])->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'add']);
        Route::put('/update', [CartController::class, 'update']);
        Route::delete('/remove', [CartController::class, 'remove']);
        Route::delete('/clear', [CartController::class, 'clear']);
        Route::post('/apply-coupon', [CartController::class, 'applyCoupon']);
        Route::post('/set-shipping', [CartController::class, 'setShipping']);
    });

    // Order routes
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::post('/', [OrderController::class, 'store']);
        Route::post('/{id}/cancel', [OrderController::class, 'cancel']);
    });

    // Products API
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    // Categories API
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    // Coupons API
    Route::prefix('coupons')->group(function () {
        Route::get('/', [CouponController::class, 'index']);
        Route::post('/', [CouponController::class, 'store']);
        Route::get('/{id}', [CouponController::class, 'show']);
        Route::put('/{id}', [CouponController::class, 'update']);
        Route::delete('/{id}', [CouponController::class, 'destroy']);
        Route::post('/validate', [CouponController::class, 'validate']);
    });

    // Shipping Methods API
    Route::prefix('shipping')->group(function () {
        Route::get('/', [ShippingMethodController::class, 'index']);
        Route::post('/', [ShippingMethodController::class, 'store']);
        Route::get('/active', [ShippingMethodController::class, 'active']);
        Route::get('/{id}', [ShippingMethodController::class, 'show']);
        Route::put('/{id}', [ShippingMethodController::class, 'update']);
        Route::delete('/{id}', [ShippingMethodController::class, 'destroy']);
    });

    // Users API
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // Analytics API
    Route::prefix('analytics')->group(function () {
        Route::get('/sales', [AnalyticsController::class, 'sales']);
        Route::get('/users', [AnalyticsController::class, 'users']);
        Route::get('/dashboard', [AnalyticsController::class, 'dashboard']);
    });
});
