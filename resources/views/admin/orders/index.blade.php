@extends('admin.layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-3xl font-bold leading-7 text-gray-900 sm:text-4xl sm:truncate">
                    Orders
                </h2>
                <p class="mt-2 text-lg text-gray-600">
                    Manage customer orders
                </p>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="mt-8">
            <div class="bg-white admin-hover shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-6">
                    @if($orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 admin-table">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Order #</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($orders as $order)
                                <tr
                                    class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div
                                            class="text-lg font-bold text-gray-900 bg-gray-100 px-3 py-1 rounded-lg inline-block">
                                            #{{ $order->id }}</div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center shadow-md">
                                                    <span class="text-sm font-bold text-white">{{
                                                        substr($order->user->name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="mr-4">
                                                <div class="text-base font-semibold text-gray-900">{{ $order->user->name
                                                    }}</div>
                                                <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="text-xl font-bold text-gray-900">${{ number_format($order->total, 2)
                                            }}</div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                       ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' :
                                                       ($order->status === 'shipped' ? 'bg-purple-100 text-purple-800' :
                                                       ($order->status === 'delivered' ? 'bg-green-100 text-green-800' :
                                                       'bg-red-100 text-red-800'))) }}">
                                            @switch($order->status)
                                                        @case('pending')
                                                            Pending
                                                            @break
                                                        @case('processing')
                                                            Processing
                                                            @break
                                                        @case('shipped')
                                                            Shipped
                                                            @break
                                                        @case('delivered')
                                                            Delivered
                                                            @break
                                                        @case('cancelled')
                                                            Cancelled
                                                            @break
                                                        @default
                                                            {{ ucfirst($order->status) }}
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $order->created_at->format('M d, Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $order->created_at->format('h:i A') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-sm font-medium">
                                        <div class="flex justify-center">
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 p-2 rounded-lg hover:bg-indigo-100 transition-colors duration-200"
                                                       title="View">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($orders->hasPages())
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                    @endif
                    @else
                    <div class="text-center py-16">
                        <div
                            class="mx-auto h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                            <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No orders</h3>
                            <p class="text-lg text-gray-500">No orders have been placed yet</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
