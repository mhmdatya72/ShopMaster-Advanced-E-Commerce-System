@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Modern Header -->
        <div class="text-center mb-12">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                    </path>
                </svg>
            </div>
            <h1
                class="text-4xl font-bold bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent mb-2">
                Secure Checkout</h1>
            <p class="text-gray-600 text-lg">Complete your purchase with confidence</p>
        </div>

        <form method="POST" action="{{ route('checkout.store') }}" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @csrf
            <!-- Hidden field for applied coupon -->
            <input type="hidden" id="applied_coupon_code" name="applied_coupon_code"
                value="{{ $appliedCoupon['code'] ?? '' }}">

            <!-- Shipping Address -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                <div class="flex items-center mb-8">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900"> Shipping Address</h2>
                        <p class="text-gray-600">Where should we deliver your order?</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="shipping_first_name" class="block text-sm font-semibold text-gray-700 mb-3">First
                            Name</label>
                        <input type="text" id="shipping_first_name" name="shipping_address[first_name]" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 bg-gray-50/50 @error('shipping_address.first_name') border-red-500 @enderror"
                            value="{{ old('shipping_address.first_name') }}" placeholder="Enter your first name">
                        @error('shipping_address.first_name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="shipping_last_name" class="block text-sm font-semibold text-gray-700 mb-3">Last
                            Name</label>
                        <input type="text" id="shipping_last_name" name="shipping_address[last_name]" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 bg-gray-50/50 @error('shipping_address.last_name') border-red-500 @enderror"
                            value="{{ old('shipping_address.last_name') }}" placeholder="Enter your last name">
                        @error('shipping_address.last_name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="shipping_email" class="block text-sm font-semibold text-gray-700 mb-3"> Email
                            Address</label>
                        <input type="email" id="shipping_email" name="shipping_address[email]" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 bg-gray-50/50 @error('shipping_address.email') border-red-500 @enderror"
                            value="{{ old('shipping_address.email') }}" placeholder="Enter your email address">
                        @error('shipping_address.email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" id="shipping_phone" name="shipping_address[phone]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address.phone') border-red-500 @enderror"
                            value="{{ old('shipping_address.phone') }}">
                        @error('shipping_address.phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input type="text" id="shipping_city" name="shipping_address[city]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address.city') border-red-500 @enderror"
                            value="{{ old('shipping_address.city') }}">
                        @error('shipping_address.city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-2">State</label>
                        <input type="text" id="shipping_state" name="shipping_address[state]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address.state') border-red-500 @enderror"
                            value="{{ old('shipping_address.state') }}">
                        @error('shipping_address.state')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal
                            Code</label>
                        <input type="text" id="shipping_postal_code" name="shipping_address[postal_code]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address.postal_code') border-red-500 @enderror"
                            value="{{ old('shipping_address.postal_code') }}">
                        @error('shipping_address.postal_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="shipping_country"
                            class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <input type="text" id="shipping_country" name="shipping_address[country]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address.country') border-red-500 @enderror"
                            value="{{ old('shipping_address.country') }}">
                        @error('shipping_address.country')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="shipping_address"
                            class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea id="shipping_address" name="shipping_address[address]" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_address.address') border-red-500 @enderror">{{ old('shipping_address.address') }}</textarea>
                        @error('shipping_address.address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Billing Address -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                <div class="flex items-center mb-8">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900"> Billing Address</h2>
                        <p class="text-gray-600">For invoice and payment purposes</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="billing_first_name" class="block text-sm font-medium text-gray-700 mb-2">First
                            Name</label>
                        <input type="text" id="billing_first_name" name="billing_address[first_name]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.first_name') border-red-500 @enderror"
                            value="{{ old('billing_address.first_name') }}">
                        @error('billing_address.first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="billing_last_name" class="block text-sm font-medium text-gray-700 mb-2">Last
                            Name</label>
                        <input type="text" id="billing_last_name" name="billing_address[last_name]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.last_name') border-red-500 @enderror"
                            value="{{ old('billing_address.last_name') }}">
                        @error('billing_address.last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="billing_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="billing_email" name="billing_address[email]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.email') border-red-500 @enderror"
                            value="{{ old('billing_address.email') }}">
                        @error('billing_address.email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="billing_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" id="billing_phone" name="billing_address[phone]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.phone') border-red-500 @enderror"
                            value="{{ old('billing_address.phone') }}">
                        @error('billing_address.phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                        <input type="text" id="billing_city" name="billing_address[city]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.city') border-red-500 @enderror"
                            value="{{ old('billing_address.city') }}">
                        @error('billing_address.city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="billing_state" class="block text-sm font-medium text-gray-700 mb-2">State</label>
                        <input type="text" id="billing_state" name="billing_address[state]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.state') border-red-500 @enderror"
                            value="{{ old('billing_address.state') }}">
                        @error('billing_address.state')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="billing_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal
                            Code</label>
                        <input type="text" id="billing_postal_code" name="billing_address[postal_code]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.postal_code') border-red-500 @enderror"
                            value="{{ old('billing_address.postal_code') }}">
                        @error('billing_address.postal_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="billing_country"
                            class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <input type="text" id="billing_country" name="billing_address[country]" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.country') border-red-500 @enderror"
                            value="{{ old('billing_address.country') }}">
                        @error('billing_address.country')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="billing_address"
                            class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea id="billing_address" name="billing_address[address]" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('billing_address.address') border-red-500 @enderror">{{ old('billing_address.address') }}</textarea>
                        @error('billing_address.address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-2">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                    <div class="text-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2
                            class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-green-900 bg-clip-text text-transparent mb-2">
                            Order Summary</h2>
                        <p class="text-gray-600">Review your order before placing it</p>
                    </div>

                    <!-- Shipping Method -->
                    <div class="mb-4">
                        <label for="shipping_method_id" class="block text-sm font-medium text-gray-700 mb-2">Shipping
                            Method</label>
                        <select id="shipping_method_id" name="shipping_method_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('shipping_method_id') border-red-500 @enderror">
                            <option value="">Select shipping method</option>
                            @foreach($shippingMethods as $method)
                            <option value="{{ $method->id }}" {{ (old('shipping_method_id')==$method->id) ||
                                (session('selected_shipping_method') == $method->id) ? 'selected' : ''
                                }}>
                                {{ $method->name }} - {{ $method->formatted_cost }}
                            </option>
                            @endforeach
                        </select>
                        @error('shipping_method_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Coupon Code -->
                    <div class="mb-4">
                        <label for="coupon_code" class="block text-sm font-medium text-gray-700 mb-2">Coupon Code
                            (Optional)</label>
                        <div class="flex space-x-2">
                            <input type="text" id="coupon_code" name="coupon_code"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('coupon_code') border-red-500 @enderror"
                                value="{{ old('coupon_code') }}" placeholder="Enter coupon code">
                            <button type="button" id="apply_coupon_btn"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-200 font-medium">
                                Apply
                            </button>
                        </div>
                        @error('coupon_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Applied Coupon Display -->
                        <div id="applied_coupon_display" class="mt-2" style="display: none;">
                            <div
                                class="flex items-center justify-between bg-green-50 border border-green-200 rounded-lg p-3">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-green-800" id="coupon_name"></span>
                                    <span class="text-sm text-green-600" id="coupon_discount"></span>
                                </div>
                                <button type="button" id="remove_coupon_btn"
                                    class="text-red-600 hover:text-red-800 transition duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Coupon Error Display -->
                        <div id="coupon_error" class="mt-2 text-sm text-red-600" style="display: none;"></div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Order Notes
                            (Optional)</label>
                        <textarea id="notes" name="notes" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Cart Items -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Items in your cart</h3>
                        <div class="space-y-4">
                            @foreach($cart->cartItems as $item)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded">
                                    @else
                                    <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    </div>
                                    @endif
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $item->formatted_total }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-200 pt-4 mt-4 space-y-2">
                            @php
                            // Calculate all values at the beginning with proper null checks
                            $subtotal = is_numeric($cart->subtotal) ? (float)$cart->subtotal : 0.0;
                            $shippingCost = 0.0;
                            $selectedShippingMethod = null;

                            if (session('selected_shipping_method')) {
                            $selectedShippingMethod =
                            \App\Models\ShippingMethod::find(session('selected_shipping_method'));
                            if ($selectedShippingMethod && is_numeric($selectedShippingMethod->cost)) {
                            $shippingCost = (float)$selectedShippingMethod->cost;
                            }
                            }

                            $discount = 0.0;
                            if ($appliedCoupon && isset($appliedCoupon['discount_percentage']) &&
                            is_numeric($appliedCoupon['discount_percentage'])) {
                            $discount = $subtotal * ((float)$appliedCoupon['discount_percentage'] / 100);
                            }

                            $total = $subtotal + $shippingCost - $discount;

                            // Debug: Log values to see what's happening
                            \Log::info('Checkout calculations:', [
                            'subtotal' => $subtotal,
                            'shippingCost' => $shippingCost,
                            'discount' => $discount,
                            'total' => $total,
                            'cart_subtotal_raw' => $cart->subtotal,
                            'appliedCoupon' => $appliedCoupon
                            ]);
                            @endphp

                            <!-- Subtotal -->
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="text-gray-900">${{ is_numeric($subtotal) ? number_format($subtotal, 2) :
                                    '0.00' }}</span>
                            </div>

                            <div class="flex justify-between text-sm" data-shipping-row style="display: none;">
                                <span class="text-gray-600">Shipping:</span>
                                <span class="text-gray-900">$0.00</span>
                            </div>


                            <!-- Discount -->
                            <div class="flex justify-between text-sm" data-discount-row style="display: none;">
                                <span class="text-gray-600">Discount:</span>
                                <span class="text-green-600">-$0.00</span>
                            </div>

                            <!-- Total -->
                            <div class="flex justify-between text-lg font-semibold border-t border-gray-200 pt-2">
                                <span>Total:</span>
                                <span>${{ is_numeric($total) ? number_format($total, 2) : '0.00' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-4 px-6 rounded-2xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                            <svg class="w-6 h-6 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                            Place Order Securely
                        </button>
                        <p class="text-center text-sm text-gray-500 mt-4 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            Your payment information is secure and encrypted
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const shippingSelect = document.getElementById('shipping_method_id');
    const totalsContainer = document.querySelector('.border-t.border-gray-200.pt-4.mt-4');
    const couponInput = document.getElementById('coupon_code');
    const applyCouponBtn = document.getElementById('apply_coupon_btn');
    const removeCouponBtn = document.getElementById('remove_coupon_btn');
    const appliedCouponDisplay = document.getElementById('applied_coupon_display');
    const couponError = document.getElementById('coupon_error');

    let appliedCoupon = @json($appliedCoupon);

    // Initialize display
    if (appliedCoupon) {
        showAppliedCoupon(appliedCoupon);

        // Update hidden field with applied coupon code
        const hiddenField = document.getElementById('applied_coupon_code');
        if (hiddenField) {
            hiddenField.value = appliedCoupon.code;
        }
    }

    if (shippingSelect && totalsContainer) {
        shippingSelect.addEventListener('change', function() {
            updateTotals();
        });

        // Initial calculation
        updateTotals();
    }

    // Coupon functionality
    if (applyCouponBtn) {
        applyCouponBtn.addEventListener('click', function() {
            const couponCode = couponInput.value.trim();
            if (couponCode) {
                applyCoupon(couponCode);
            }
        });
    }

    if (removeCouponBtn) {
        removeCouponBtn.addEventListener('click', function() {
            removeCoupon();
        });
    }

    // Allow Enter key to apply coupon
    if (couponInput) {
        couponInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const couponCode = couponInput.value.trim();
                if (couponCode) {
                    applyCoupon(couponCode);
                }
            }
        });

        // Check for duplicate coupon on input
        couponInput.addEventListener('input', function() {
            const couponCode = couponInput.value.trim();
            if (appliedCoupon && appliedCoupon.code === couponCode) {
                showCouponError('This coupon is already applied to your order');
            } else {
                hideCouponError();
            }
        });
    }

    function applyCoupon(couponCode) {
        // Check if coupon is already applied
        if (appliedCoupon && appliedCoupon.code === couponCode) {
            showCouponError('This coupon is already applied to your order');
            return;
        }

        // Disable button during request
        applyCouponBtn.disabled = true;
        applyCouponBtn.textContent = 'Applying...';
        hideCouponError();

        fetch('{{ route("cart.apply-coupon") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ code: couponCode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                appliedCoupon = data.coupon;
                showAppliedCoupon(appliedCoupon);
                couponInput.value = '';

                // Update hidden field with applied coupon code
                const hiddenField = document.getElementById('applied_coupon_code');
                if (hiddenField) {
                    hiddenField.value = appliedCoupon.code;
                }

                updateTotals();
                showCouponSuccess('Coupon applied successfully!');
            } else {
                showCouponError(data.message || 'Invalid coupon code');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showCouponError('Failed to apply coupon. Please try again.');
        })
        .finally(() => {
            applyCouponBtn.disabled = false;
            applyCouponBtn.textContent = 'Apply';
        });
    }

    function removeCoupon() {
        fetch('{{ route("cart.remove-coupon") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                appliedCoupon = null;
                hideAppliedCoupon();

                // Clear hidden field
                const hiddenField = document.getElementById('applied_coupon_code');
                if (hiddenField) {
                    hiddenField.value = '';
                }

                updateTotals();
                showCouponSuccess('Coupon removed successfully!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function showAppliedCoupon(coupon) {
        document.getElementById('coupon_name').textContent = coupon.code;
        document.getElementById('coupon_discount').textContent = `${coupon.discount_percentage}% off`;
        appliedCouponDisplay.style.display = 'block';
        couponInput.disabled = true;
        applyCouponBtn.disabled = true;
        applyCouponBtn.textContent = 'Applied';
    }

    function hideAppliedCoupon() {
        appliedCouponDisplay.style.display = 'none';
        couponInput.disabled = false;
        applyCouponBtn.disabled = false;
        applyCouponBtn.textContent = 'Apply';
    }

    function showCouponError(message) {
        couponError.textContent = message;
        couponError.style.display = 'block';
        setTimeout(() => hideCouponError(), 5000);
    }

    function hideCouponError() {
        couponError.style.display = 'none';
    }

    function showCouponSuccess(message) {
        // Create temporary success message
        const successDiv = document.createElement('div');
        successDiv.className = 'mt-2 text-sm text-green-600';
        successDiv.textContent = message;
        successDiv.id = 'coupon_success';

        // Remove existing success message
        const existingSuccess = document.getElementById('coupon_success');
        if (existingSuccess) {
            existingSuccess.remove();
        }

        // Add new success message
        couponInput.parentNode.parentNode.appendChild(successDiv);

        // Remove after 3 seconds
        setTimeout(() => {
            if (successDiv.parentNode) {
                successDiv.remove();
            }
        }, 3000);
    }

    function updateTotals() {
        const selectedMethodId = shippingSelect.value;

        // Get shipping method data
        const shippingMethods = @json($shippingMethods);
        const selectedMethod = shippingMethods.find(method => method.id == selectedMethodId);

        // Get cart data with proper validation
        const cartSubtotal = isNaN({{ $cart->subtotal ?? 0 }}) ? 0 : parseFloat({{ $cart->subtotal ?? 0 }});

        // Calculate values with proper validation
        const shippingCost = selectedMethod ? (isNaN(parseFloat(selectedMethod.cost)) ? 0 : parseFloat(selectedMethod.cost)) : 0;
        const discount = (appliedCoupon && appliedCoupon.discount_percentage && !isNaN(parseFloat(appliedCoupon.discount_percentage)))
            ? cartSubtotal * (parseFloat(appliedCoupon.discount_percentage) / 100)
            : 0;
        const total = cartSubtotal + shippingCost - discount;

        // Debug logging
        console.log('Checkout calculations:', {
            cartSubtotal,
            shippingCost,
            discount,
            total,
            selectedMethod,
            appliedCoupon
        });

        // Update shipping display
        const shippingRow = totalsContainer.querySelector('[data-shipping-row]');
        if (shippingRow) {
            shippingRow.style.display = selectedMethod ? 'flex' : 'none';
            if (selectedMethod) {
                const shippingValue = isNaN(shippingCost) ? 0 : shippingCost;
                shippingRow.querySelector('span:last-child').textContent = `$${shippingValue.toFixed(2)}`;
            }
        }

        // Update discount display
        const discountRow = totalsContainer.querySelector('[data-discount-row]');
        if (discountRow) {
            discountRow.style.display = appliedCoupon ? 'flex' : 'none';
            if (appliedCoupon) {
                const discountValue = isNaN(discount) ? 0 : discount;
                discountRow.querySelector('span:last-child').textContent = `-$${discountValue.toFixed(2)}`;
            }
        }

        // Update total
        const totalRow = totalsContainer.querySelector('.text-lg.font-semibold');
        if (totalRow) {
            const totalValue = isNaN(total) ? 0 : total;
            totalRow.querySelector('span:last-child').textContent = `$${totalValue.toFixed(2)}`;
        }
    }
});
</script>
@endpush
