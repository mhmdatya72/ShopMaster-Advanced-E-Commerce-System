@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Order #{{ $order->id }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.orders.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    ← Back to Orders
                </a>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Order Details -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                            <div class="flex items-center space-x-4 border-b border-gray-200 pb-4">
                                @if($item->product->image)
                                <img class="h-16 w-16 rounded-lg object-cover"
                                    src="{{ asset('storage/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}">
                                @else
                                <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h4>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-500">Price: ${{ number_format($item->price, 2) }}</p>
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Subtotal:</span>
                                <span class="text-gray-900">${{ number_format($order->subtotal, 2) }}</span>
                            </div>

                            @if($order->discount_amount > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Discount:</span>
                                <span class="text-green-600">-${{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                            @endif

                            @if($order->shipping_cost > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Shipping:</span>
                                <span class="text-gray-900">${{ number_format($order->shipping_cost, 2) }}</span>
                            </div>
                            @endif


                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-base font-medium">
                                    <span class="text-gray-900">Total:</span>
                                    <span class="text-gray-900">${{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status Update -->
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Update Status</h4>
                            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : ''
                                        }}>Processing</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped
                                    </option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : ''
                                        }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : ''
                                        }}>Cancelled</option>
                                </select>
                                <button type="submit"
                                    class="mt-2 w-full bg-indigo-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Status
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
                        <div class="space-y-2">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Name:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $order->user->name }}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Email:</span>
                                <span class="text-sm text-gray-900 ml-2">{{ $order->user->email }}</span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Phone:</span>
                                <span class="text-sm text-gray-900 ml-2">
                                    @if(is_array($order->shipping_address) && isset($order->shipping_address['phone']))
                                    {{ $order->shipping_address['phone'] }}
                                    @else
                                    N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Shipping Address</h3>
                        <div class="text-sm text-gray-900">
                            @if(is_array($order->shipping_address))
                            {{ $order->shipping_address['first_name'] }} {{ $order->shipping_address['last_name'] }}<br>
                            {{ $order->shipping_address['address'] }}<br>
                            {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} {{
                            $order->shipping_address['postal_code'] }}<br>
                            {{ $order->shipping_address['country'] }}<br>
                            <strong>Email:</strong> {{ $order->shipping_address['email'] }}<br>
                            <strong>Phone:</strong> {{ $order->shipping_address['phone'] }}
                            @else
                            {{ $order->shipping_address }}<br>
                            {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
                            {{ $order->country }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Billing Address -->
                <div class="mt-6 bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Billing Address</h3>
                        <div class="text-sm text-gray-900">
                            @if(is_array($order->billing_address))
                            {{ $order->billing_address['first_name'] }} {{ $order->billing_address['last_name'] }}<br>
                            {{ $order->billing_address['address'] }}<br>
                            {{ $order->billing_address['city'] }}, {{ $order->billing_address['state'] }} {{
                            $order->billing_address['postal_code'] }}<br>
                            {{ $order->billing_address['country'] }}<br>
                            <strong>Email:</strong> {{ $order->billing_address['email'] }}<br>
                            <strong>Phone:</strong> {{ $order->billing_address['phone'] }}
                            @else
                            {{ $order->billing_address ?? 'Same as shipping address' }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection