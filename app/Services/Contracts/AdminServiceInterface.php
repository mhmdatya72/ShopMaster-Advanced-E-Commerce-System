<?php

namespace App\Services\Contracts;

interface AdminServiceInterface
{
    /**
     * Get dashboard statistics.
     */
    public function getDashboardStats(): array;

    /**
     * Get recent orders.
     */
    public function getRecentOrders(int $limit = 10): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get sales analytics.
     */
    public function getSalesAnalytics(int $days = 30): array;

    /**
     * Get user analytics.
     */
    public function getUserAnalytics(int $days = 30): array;
}
