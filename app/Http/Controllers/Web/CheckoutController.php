<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Contracts\CartServiceInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\CouponServiceInterface;
use App\Services\Contracts\ShippingServiceInterface;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private CartServiceInterface $cartService,
        private OrderServiceInterface $orderService,
        private CouponServiceInterface $couponService,
        private ShippingServiceInterface $shippingService
    ) {}

    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cart = $this->cartService->getOrCreateCart(
            auth()->id(),
            session()->getId()
        );

        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty');
        }

        $shippingMethods = $this->shippingService->getActiveShippingMethods();
        $appliedCoupon = session('applied_coupon');

        return view('checkout.index', compact('cart', 'shippingMethods', 'appliedCoupon'));
    }

    /**
     * Process the checkout.
     */
    public function store(CheckoutRequest $request)
    {
        $cart = $this->cartService->getOrCreateCart(
            auth()->id(),
            session()->getId()
        );

        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty');
        }

        try {
            // Get applied coupon from session or form
            $appliedCoupon = session('applied_coupon');
            $couponCode = $request->applied_coupon_code ?: $request->coupon_code;
            
            $order = $this->orderService->createOrderFromCart($cart, [
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address,
                'shipping_method_id' => $request->shipping_method_id,
                'coupon_code' => $couponCode,
                'notes' => $request->notes,
            ]);

            session()->forget('applied_coupon');

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}
