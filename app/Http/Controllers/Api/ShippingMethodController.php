<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\StoreShippingMethodRequest;
use App\Http\Requests\UpdateShippingMethodRequest;
use App\Http\Resources\ShippingMethodResource;
use App\Services\Contracts\ShippingMethodServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShippingMethodController extends BaseController
{
    public function __construct(
        private ShippingMethodServiceInterface $shippingMethodService
    ) {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'active']]);
    }

    /**
     * Display a listing of shipping methods.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 15);
        $active = $request->get('active');

        $shippingMethods = $this->shippingMethodService->getAllShippingMethods($perPage, $active);

        return response()->json([
            'success' => true,
            'data' => ShippingMethodResource::collection($shippingMethods),
            'meta' => [
                'current_page' => $shippingMethods->currentPage(),
                'last_page' => $shippingMethods->lastPage(),
                'per_page' => $shippingMethods->perPage(),
                'total' => $shippingMethods->total(),
            ]
        ]);
    }

    /**
     * Store a newly created shipping method.
     */
    public function store(StoreShippingMethodRequest $request): JsonResponse
    {
        try {
            $shippingMethod = $this->shippingMethodService->createShippingMethod($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Shipping method created successfully',
                'data' => new ShippingMethodResource($shippingMethod)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create shipping method: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified shipping method.
     */
    public function show(string $id): JsonResponse
    {
        $shippingMethod = $this->shippingMethodService->getShippingMethodById($id);

        if (!$shippingMethod) {
            return response()->json([
                'success' => false,
                'message' => 'Shipping method not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new ShippingMethodResource($shippingMethod)
        ]);
    }

    /**
     * Update the specified shipping method.
     */
    public function update(UpdateShippingMethodRequest $request, string $id): JsonResponse
    {
        try {
            $shippingMethod = $this->shippingMethodService->updateShippingMethod($id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Shipping method updated successfully',
                'data' => new ShippingMethodResource($shippingMethod)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update shipping method: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified shipping method.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->shippingMethodService->deleteShippingMethod($id);

            return response()->json([
                'success' => true,
                'message' => 'Shipping method deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete shipping method: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get active shipping methods.
     */
    public function active(): JsonResponse
    {
        $shippingMethods = $this->shippingMethodService->getActiveShippingMethods();

        return response()->json([
            'success' => true,
            'data' => ShippingMethodResource::collection($shippingMethods)
        ]);
    }
}
