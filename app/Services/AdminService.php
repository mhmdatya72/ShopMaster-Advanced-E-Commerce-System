<?php

namespace App\Services;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Services\Contracts\AdminServiceInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminService implements AdminServiceInterface
{
    /**
     * Get dashboard statistics.
     */
    public function getDashboardStats(): array
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalSales = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $totalCategories = Category::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'delivered')->count();

        return [
            'total_customers' => $totalUsers,
            'total_products' => $totalProducts,
            'total_orders' => $totalOrders,
            'total_revenue' => $totalSales,
            'total_categories' => $totalCategories,
            'pending_orders' => $pendingOrders,
            'completed_orders' => $completedOrders,
            'formatted_total_sales' => '$' . number_format($totalSales, 2),
        ];
    }

    /**
     * Get recent orders.
     */
    public function getRecentOrders(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return Order::with(['user', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get sales analytics.
     */
    public function getSalesAnalytics(int $days = 30): array
    {
        $startDate = Carbon::now()->subDays($days);

        $dailySales = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(total_amount) as total_sales')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $monthlySales = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as orders_count'),
                DB::raw('SUM(total_amount) as total_sales')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return [
            'daily_sales' => $dailySales,
            'monthly_sales' => $monthlySales,
            'total_sales_period' => $dailySales->sum('total_sales'),
            'average_order_value' => $dailySales->count() > 0 ? $dailySales->sum('total_sales') / $dailySales->count() : 0,
        ];
    }

    /**
     * Get user analytics.
     */
    public function getUserAnalytics(int $days = 30): array
    {
        $startDate = Carbon::now()->subDays($days);

        $newUsers = User::where('created_at', '>=', $startDate)->count();
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $customerUsers = User::where('role', 'customer')->count();

        $userGrowth = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as new_users')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'new_users' => $newUsers,
            'total_users' => $totalUsers,
            'admin_users' => $adminUsers,
            'customer_users' => $customerUsers,
            'user_growth' => $userGrowth,
        ];
    }
}
