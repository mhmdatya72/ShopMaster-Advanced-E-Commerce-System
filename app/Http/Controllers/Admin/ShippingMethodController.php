<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use App\Http\Requests\Admin\StoreShippingMethodRequest;
use App\Http\Requests\Admin\UpdateShippingMethodRequest;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of shipping methods.
     */
    public function index(Request $request)
    {
        $query = ShippingMethod::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }

        $shippingMethods = $query->withCount('orders')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.shipping-methods.index', compact('shippingMethods'));
    }

    /**
     * Show the form for creating a new shipping method.
     */
    public function create()
    {
        return view('admin.shipping-methods.create');
    }

    /**
     * Store a newly created shipping method.
     */
    public function store(StoreShippingMethodRequest $request)
    {
        ShippingMethod::create($request->validated());

        return redirect()->route('admin.shipping-methods.index')
            ->with('success', 'Shipping method created successfully.');
    }

    /**
     * Display the specified shipping method.
     */
    public function show(ShippingMethod $shippingMethod)
    {
        $shippingMethod->load('orders');
        return view('admin.shipping-methods.show', compact('shippingMethod'));
    }

    /**
     * Show the form for editing the specified shipping method.
     */
    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.shipping-methods.edit', compact('shippingMethod'));
    }

    /**
     * Update the specified shipping method.
     */
    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        $shippingMethod->update($request->validated());

        return redirect()->route('admin.shipping-methods.index')
            ->with('success', 'Shipping method updated successfully.');
    }

    /**
     * Remove the specified shipping method.
     */
    public function destroy(ShippingMethod $shippingMethod)
    {
        // Check if shipping method has orders
        if ($shippingMethod->orders()->count() > 0) {
            return redirect()->route('admin.shipping-methods.index')
                ->with('error', 'Cannot delete shipping method that has been used in orders. You can deactivate it instead.');
        }

        $shippingMethod->delete();

        return redirect()->route('admin.shipping-methods.index')
            ->with('success', 'Shipping method deleted successfully.');
    }
}
