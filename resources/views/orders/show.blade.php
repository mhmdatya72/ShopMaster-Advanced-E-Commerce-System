@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Modern Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-3 text-sm">
                <li>
                    <a href="{{ route('home') }}"
                        class="flex items-center text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Home
                    </a>
                </li>
                <li class="text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}"
                        class="text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                        Orders
                    </a>
                </li>
                <li class="text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </li>
                <li class="text-indigo-600 font-semibold">
                    Order #{{ $order->order_number }}
                </li>
            </ol>
        </nav>

        <!-- Modern Order Header -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden mb-8">
            <div class="px-8 py-6 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->order_number }}</h1>
                            <p class="text-gray-600 flex items-center mt-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div
                            class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-3">
                            {{ $order->formatted_total }}
                        </div>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                            @if($order->status === 'pending') bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 border border-yellow-200
                            @elseif($order->status === 'processing') bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 border border-blue-200
                            @elseif($order->status === 'shipped') bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 border border-purple-200
                            @elseif($order->status === 'delivered') bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200
                            @elseif($order->status === 'cancelled') bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200
                            @endif">
                            @if($order->status === 'pending')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @elseif($order->status === 'processing')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            @elseif($order->status === 'shipped')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            @elseif($order->status === 'delivered')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            @elseif($order->status === 'cancelled')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            @endif
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="xl:col-span-2">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-orange-50 to-red-50 border-b border-gray-100">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900"> Order Items</h2>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="space-y-6">
                            @foreach($order->orderItems as $item)
                            <div
                                class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-center space-x-6">
                                    @if($item->product->image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-20 h-20 object-cover rounded-2xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        </div>
                                    </div>
                                    @else
                                    <div
                                        class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center shadow-lg">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    @endif
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->product->name }}</h3>
                                        <div class="flex items-center space-x-4 text-sm text-gray-600 mb-3">
                                            <span
                                                class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full font-semibold">
                                                {{ $item->product->category->name }}
                                            </span>
                                            <span
                                                class="px-3 py-1 bg-green-100 text-green-700 rounded-full font-semibold">
                                                Qty: {{ $item->quantity }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="text-sm text-gray-500">
                                                Unit Price: <span class="font-semibold text-gray-900">{{
                                                    $item->formatted_price }}</span>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-2xl font-bold text-indigo-600">
                                                    {{ $item->formatted_total }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Details Sidebar -->
            <div class="space-y-6">
                <!-- Shipping Address -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Shipping Address</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-700 space-y-2">
                            <p class="font-bold text-lg text-gray-900">{{ $order->shipping_address['first_name'] }} {{
                                $order->shipping_address['last_name'] }}</p>
                            <p class="text-gray-600">{{ $order->shipping_address['address'] }}</p>
                            <p class="text-gray-600">{{ $order->shipping_address['city'] }}, {{
                                $order->shipping_address['state'] }} {{ $order->shipping_address['postal_code'] }}</p>
                            <p class="font-semibold text-indigo-600">{{ $order->shipping_address['country'] }}</p>
                            <div class="border-t border-gray-200 pt-3 mt-4">
                                <p class="text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    {{ $order->shipping_address['phone'] }}
                                </p>
                                <p class="text-gray-600 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $order->shipping_address['email'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Billing Address -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-100">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Billing Address</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-700 space-y-2">
                            <p class="font-bold text-lg text-gray-900">{{ $order->billing_address['first_name'] }} {{
                                $order->billing_address['last_name'] }}</p>
                            <p class="text-gray-600">{{ $order->billing_address['address'] }}</p>
                            <p class="text-gray-600">{{ $order->billing_address['city'] }}, {{
                                $order->billing_address['state'] }} {{ $order->billing_address['postal_code'] }}</p>
                            <p class="font-semibold text-purple-600">{{ $order->billing_address['country'] }}</p>
                            <div class="border-t border-gray-200 pt-3 mt-4">
                                <p class="text-gray-600 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    {{ $order->billing_address['phone'] }}
                                </p>
                                <p class="text-gray-600 flex items-center mt-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $order->billing_address['email'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-100">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Order Summary</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Subtotal:</span>
                                <span class="font-bold text-gray-900">{{ $order->formatted_subtotal }}</span>
                            </div>

                            @if($order->shipping_cost > 0)
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Shipping:</span>
                                <span class="font-bold text-gray-900">${{ number_format($order->shipping_cost, 2)
                                    }}</span>
                            </div>
                            @endif

                            @if($order->discount_amount > 0)
                            <div class="flex justify-between items-center py-2 text-green-600">
                                <span class="font-medium">Discount:</span>
                                <span class="font-bold">-${{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif


                            <div class="border-t-2 border-gray-300 pt-4 mt-4">
                                <div class="flex justify-between items-center text-xl font-bold">
                                    <span class="text-gray-900">Total:</span>
                                    <span
                                        class="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">{{
                                        $order->formatted_total }}</span>
                                </div>
                            </div>
                        </div>

                        @if($order->coupon)
                        <div
                            class="mt-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-sm font-bold text-green-800">Coupon Applied</p>
                                    <p class="text-xs text-green-700">{{ $order->coupon->code }} ({{
                                        $order->coupon->discount_type === 'percent' ? $order->coupon->discount_value .
                                        '%' : '$' . $order->coupon->discount_value }} off)</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($order->shippingMethod)
                        <div
                            class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border border-blue-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-bold text-blue-800">Shipping Method</p>
                                    <p class="text-xs text-blue-700">{{ $order->shippingMethod->name }} ({{
                                        $order->shippingMethod->estimated_days }} days)</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($order->notes)
                        <div
                            class="mt-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-600 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Order Notes</p>
                                    <p class="text-xs text-gray-700 mt-1">{{ $order->notes }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Order Actions -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="px-6 py-6">
                        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                            <a href="{{ route('orders.index') }}"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-semibold rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Orders
                            </a>

                            @if($order->canBeCancelled())
                            <form method="POST" action="{{ route('orders.cancel', $order->id) }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-pink-600 text-white font-semibold rounded-xl hover:from-red-600 hover:to-pink-700 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
                                    onclick="return confirm('Are you sure you want to cancel this order?')">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Cancel Order
                                </button>
                            </form>
                            @else
                            <div class="text-sm text-gray-500 italic bg-gray-100 px-4 py-2 rounded-lg">
                                This order cannot be cancelled
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
