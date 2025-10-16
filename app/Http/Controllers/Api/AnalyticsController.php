<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Resources\OrderResource;
use App\Services\Contracts\AdminServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsController extends BaseController
{
    public function __construct(
        private AdminServiceInterface $adminService
    ) {
        $this->middleware('auth:api');
    }

    /**
     * Get sales analytics.
     */
    public function sales(Request $request): JsonResponse
    {
        $days = $request->get('days', 30);
        $analytics = $this->adminService->getSalesAnalytics($days);

        return response()->json([
            'success' => true,
            'data' => $analytics
        ]);
    }

    /**
     * Get user analytics.
     */
    public function users(Request $request): JsonResponse
    {
        $days = $request->get('days', 30);
        $analytics = $this->adminService->getUserAnalytics($days);

        return response()->json([
            'success' => true,
            'data' => $analytics
        ]);
    }

    /**
     * Get dashboard statistics.
     */
    public function dashboard(): JsonResponse
    {
        $stats = $this->adminService->getDashboardStats();
        $recentOrders = $this->adminService->getRecentOrders(5);

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => $stats,
                'recent_orders' => OrderResource::collection($recentOrders)
            ]
        ]);
    }
}