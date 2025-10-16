@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Modern Header -->
        <div class="text-center mb-12">
            <div
                class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl mb-6 shadow-xl">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h1
                class="text-5xl font-bold bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-4">
                ShopMaster Products
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Advanced E-Commerce System - Discover our amazing collection of premium products designed to enhance
                your lifestyle
            </p>
        </div>

        <!-- Modern Filters and Search -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 mb-12 border border-white/20">
            <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search Products
                        </label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ $query }}"
                                placeholder="What are you looking for?"
                                class="w-full px-6 py-4 pl-12 bg-gray-50 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 text-lg">
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="lg:w-80">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            Category
                        </label>
                        <select name="category"
                            class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-300 text-lg">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $categoryId==$category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lg:w-auto flex items-end">
                        <button type="submit"
                            class="w-full lg:w-auto bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-2xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div
                class="group bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 flex flex-col h-full border border-white/20">
                <!-- Product Image -->
                <div class="relative overflow-hidden">
                    @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                        class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div
                        class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span class="text-gray-500 font-medium">No Image</span>
                        </div>
                    </div>
                    @endif

                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4">
                        <span
                            class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Stock Badge -->
                    <div class="absolute top-4 right-4">
                        @if($product->isInStock())
                        <span
                            class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            In Stock
                        </span>
                        @else
                        <span
                            class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            Out of Stock
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div class="p-6 flex flex-col flex-grow">
                    <h3
                        class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors duration-300">
                        {{ $product->name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow leading-relaxed">
                        {{ Str::limit($product->description, 80) }}
                    </p>

                    <!-- Price and Stock Info -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex flex-col">
                            <span
                                class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                {{ $product->formatted_price }}
                            </span>
                            <span class="text-sm text-gray-500">{{ $product->stock }} available</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3 mt-auto">
                        <a href="{{ route('products.show', $product->slug) }}"
                            class="group/btn w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-4 rounded-2xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 text-center block transform hover:scale-105 hover:shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 group-hover/btn:translate-x-1 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                View Details
                            </span>
                        </a>

                        @if($product->isInStock())
                        @auth
                        <button onclick="addToCart({{ $product->id }})"
                            class="group/cart w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-4 rounded-2xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 group-hover/cart:scale-110 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                    </path>
                                </svg>
                                Add to Cart
                            </span>
                        </button>
                        @else
                        <a href="{{ route('login', ['redirect' => 'add-to-cart', 'product_id' => $product->id]) }}"
                            class="group/cart w-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-4 rounded-2xl font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 text-center block transform hover:scale-105">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 group-hover/cart:scale-110 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Login to Add
                            </span>
                        </a>
                        @endauth
                        @else
                        <button disabled
                            class="w-full bg-gradient-to-r from-gray-300 to-gray-400 text-gray-500 py-3 px-4 rounded-2xl font-semibold cursor-not-allowed">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Out of Stock
                            </span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <div
                    class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-12 max-w-md mx-auto border border-white/20">
                    <div
                        class="w-24 h-24 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No Products Found</h3>
                    <p class="text-gray-600 text-lg mb-6">We couldn't find any products matching your criteria.</p>
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        View All Products
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Modern Pagination -->
        @if($products->hasPages())
        <div class="mt-16 flex justify-center">
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl p-4 border border-white/20">
                {{ $products->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    function addToCart(productId) {
    const button = event.target.closest('button');
    const originalText = button.innerHTML;

    // Show loading state
    button.innerHTML = `
        <span class="flex items-center justify-center">
            <svg class="animate-spin w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Adding...
        </span>
    `;
    button.disabled = true;

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success state
            button.innerHTML = `
                <span class="flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Added!
                </span>
            `;
            button.classList.remove('from-green-600', 'to-emerald-600');
            button.classList.add('from-green-500', 'to-green-600');

            // Show notification
            showNotification('Product added to cart successfully!', 'success');

            // Update cart count
            updateCartCount();

            // Reset button after 2 seconds
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
                button.classList.remove('from-green-500', 'to-green-600');
                button.classList.add('from-green-600', 'to-emerald-600');
            }, 2000);
        } else {
            throw new Error(data.message || 'Failed to add product to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);

        // Show error state
        button.innerHTML = `
            <span class="flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Error
            </span>
        `;
        button.classList.remove('from-green-600', 'to-emerald-600');
        button.classList.add('from-red-500', 'to-red-600');

        showNotification(error.message || 'Failed to add product to cart', 'error');

        // Reset button after 2 seconds
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            button.classList.remove('from-red-500', 'to-red-600');
            button.classList.add('from-green-600', 'to-emerald-600');
        }, 2000);
    });
}

function updateCartCount() {
    // Update cart count in header if element exists
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        fetch('/cart/count', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cartCountElement.textContent = data.count;
            }
        })
        .catch(error => console.error('Error updating cart count:', error));
    }
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-2xl shadow-xl z-50 max-w-sm ${
        type === 'success'
            ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white'
            : 'bg-gradient-to-r from-red-500 to-pink-600 text-white'
    }`;

    notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success'
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'
                }
            </svg>
            <span class="font-semibold">${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    notification.style.transform = 'translateX(100%)';
    notification.style.opacity = '0';
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
        notification.style.opacity = '1';
        notification.style.transition = 'all 0.3s ease-out';
    }, 100);

    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        notification.style.opacity = '0';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}
</script>
@endpush
@endsection
