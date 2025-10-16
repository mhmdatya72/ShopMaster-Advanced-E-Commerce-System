<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\AdminServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        private AdminServiceInterface $adminService
    ) {}

    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = $this->adminService->getDashboardStats();
        $recentOrders = $this->adminService->getRecentOrders(5);
        $salesAnalytics = $this->adminService->getSalesAnalytics(30);
        $userAnalytics = $this->adminService->getUserAnalytics(30);

        return view('admin.dashboard', compact('stats', 'recentOrders', 'salesAnalytics', 'userAnalytics'));
    }
}
