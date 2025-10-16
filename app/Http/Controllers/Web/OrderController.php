<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private OrderServiceInterface $orderService
    ) {}

    /**
     * Display a listing of user orders.
     */
    public function index()
    {
        $orders = $this->orderService->getUserOrders(auth()->user());

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(int $id)
    {
        $order = $this->orderService->getOrderById($id);

        if (!$order || $order->user_id !== auth()->id()) {
            abort(404);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Cancel the specified order.
     */
    public function cancel(int $id)
    {
        $order = $this->orderService->getOrderById($id);

        if (!$order || $order->user_id !== auth()->id()) {
            abort(404);
        }

        try {
            $this->orderService->cancelOrder($order);

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Order cancelled successfully');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Failed to cancel order: ' . $e->getMessage());
        }
    }
}
