@extends('admin.layouts.app')

@section('title', 'Shipping Methods Management')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-3xl font-bold leading-7 text-gray-900 sm:text-4xl sm:truncate">
                    Shipping Methods
                </h2>
                <p class="mt-2 text-lg text-gray-600">
                    Manage shipping and delivery methods
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.shipping-methods.create') }}"
                    class="btn-modern inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-sm font-medium text-white admin-gradient hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add New Shipping Method
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        <!-- Shipping Methods Table -->
        <div class="mt-8">
            <div class="bg-white admin-hover shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-6">
                    @if($shippingMethods->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 admin-table">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cost</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estimated Days</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Orders Count</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Created At</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($shippingMethods as $method)
                                <tr
                                    class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="text-base font-semibold text-gray-900">{{ $method->name }}</div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="text-sm text-gray-600 line-clamp-2">{{ $method->description ?? 'No
                                            description' }}</div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="text-lg font-bold text-gray-900">
                                            @if($method->cost > 0)
                                            ${{ number_format($method->cost, 2) }}
                                            @else
                                            <span class="text-green-600 font-medium">Free</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $method->estimated_days }} days
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                            {{ $method->orders_count ?? 0 }} orders
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        @if($method->is_active)
                                        <span
                                            class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                        @else
                                        <span
                                            class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $method->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3 justify-center">
                                            <a href="{{ route('admin.shipping-methods.edit', $method) }}"
                                                class="text-indigo-600 hover:text-indigo-900 p-2 rounded-lg hover:bg-indigo-100 transition-colors duration-200"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <button
                                                onclick="showDeleteModal('{{ route('admin.shipping-methods.destroy', $method) }}', 'Delete Shipping Method', 'Are you sure you want to delete the shipping method &quot;{{ $method->name }}&quot;? This action cannot be undone.')"
                                                class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-100 transition-colors duration-200"
                                                title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-16 text-center">
                                        <div
                                            class="mx-auto h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No shipping methods</h3>
                                        <p class="text-lg text-gray-500 mb-8">Get started by creating a new shipping
                                            method to manage delivery
                                        </p>
                                        <div>
                                            <a href="{{ route('admin.shipping-methods.create') }}"
                                                class="btn-modern inline-flex items-center px-6 py-3 border border-transparent shadow-lg text-sm font-medium rounded-xl text-white admin-gradient hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition-all duration-200">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Add New Shipping Method
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($shippingMethods->hasPages())
                    <div class="mt-6">
                        {{ $shippingMethods->links() }}
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
