<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Http\Resources\CouponResource;
use App\Services\Contracts\CouponServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends BaseController
{
    public function __construct(
        private CouponServiceInterface $couponService
    ) {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'validate']]);
    }

    /**
     * Display a listing of coupons.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $active = $request->get('active');

        $coupons = $this->couponService->getAllCoupons($perPage, $active);

        return response()->json([
            'success' => true,
            'data' => CouponResource::collection($coupons),
            'meta' => [
                'current_page' => $coupons->currentPage(),
                'last_page' => $coupons->lastPage(),
                'per_page' => $coupons->perPage(),
                'total' => $coupons->total(),
            ]
        ]);
    }

    /**
     * Store a newly created coupon.
     */
    public function store(StoreCouponRequest $request): JsonResponse
    {
        try {
            $coupon = $this->couponService->createCoupon($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Coupon created successfully',
                'data' => new CouponResource($coupon)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create coupon: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified coupon.
     */
    public function show(string $id): JsonResponse
    {
        $coupon = $this->couponService->getCouponById($id);

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new CouponResource($coupon)
        ]);
    }

    /**
     * Update the specified coupon.
     */
    public function update(UpdateCouponRequest $request, string $id): JsonResponse
    {
        try {
            $coupon = $this->couponService->updateCoupon($id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Coupon updated successfully',
                'data' => new CouponResource($coupon)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update coupon: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified coupon.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->couponService->deleteCoupon($id);

            return response()->json([
                'success' => true,
                'message' => 'Coupon deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete coupon: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Validate coupon code.
     */
    public function validate(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
            'order_value' => 'required|numeric|min:0'
        ]);

        $coupon = $this->couponService->validateCoupon($request->code, $request->order_value);

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code',
                'discount' => 0
            ]);
        }

        if (!$coupon->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon is no longer valid',
                'discount' => 0
            ]);
        }

        if (!$coupon->canBeAppliedTo($request->order_value)) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon cannot be applied to this order value',
                'discount' => 0
            ]);
        }

        $discount = $coupon->calculateDiscount($request->order_value);

        return response()->json([
            'success' => true,
            'message' => 'Coupon is valid',
            'discount' => $discount,
            'coupon' => new CouponResource($coupon)
        ]);
    }
}
