@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="min-h-screen overflow-hidden">
    <!-- Hero Section with Advanced Animations -->
    <div class="relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900 text-white overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full">
                <div
                    class="absolute top-10 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                </div>
                <div
                    class="absolute top-0 right-4 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
                </div>
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full animate-ping"></div>
            <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-white rounded-full animate-ping animation-delay-1000">
            </div>
            <div
                class="absolute bottom-1/4 left-1/3 w-1.5 h-1.5 bg-white rounded-full animate-ping animation-delay-2000">
            </div>
            <div class="absolute top-2/3 right-1/4 w-1 h-1 bg-white rounded-full animate-ping animation-delay-3000">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <!-- Main Heading with Staggered Animation -->
                <div class="space-y-4">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in-up">
                        <span
                            class="bg-gradient-to-r from-white via-purple-200 to-pink-200 bg-clip-text text-transparent">
                            Welcome to
                        </span>
                        <br>
                        <span
                            class="bg-gradient-to-r from-pink-400 via-purple-400 to-indigo-400 bg-clip-text text-transparent animate-gradient-x">
                            ShopMaster
                        </span>
                    </h1>

                    <!-- Subtitle with Typewriter Effect -->
                    <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto animate-fade-in-up animation-delay-500 opacity-0"
                        id="typewriter">
                        Advanced E-Commerce System with modern features. Discover amazing products at unbeatable prices.
                        Shop with confidence and enjoy fast, reliable delivery.
                    </p>
                </div>

                <!-- CTA Buttons with Hover Effects -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 animate-fade-in-up animation-delay-1000">
                    <a href="{{ route('products.index') }}"
                        class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-indigo-600 bg-white rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <span class="relative z-10">Shop Now</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>

                    <a href="{{ route('cart.index') }}"
                        class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white hover:text-indigo-600 transition-all duration-300 transform hover:scale-105">
                        <span class="relative z-10">View Cart</span>
                        <div
                            class="absolute inset-0 bg-white rounded-full scale-0 group-hover:scale-100 transition-transform duration-300">
                        </div>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-y-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                            </path>
                        </svg>
                    </a>

                    <a href="#featured"
                        class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white hover:text-indigo-600 transition-all duration-300 transform hover:scale-105">
                        <span class="relative z-10">Featured Products</span>
                        <div
                            class="absolute inset-0 bg-white rounded-full scale-0 group-hover:scale-100 transition-transform duration-300">
                        </div>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-y-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                </path>
            </svg>
        </div>
    </div>

    <!-- Featured Products Section -->
    <section id="featured" class="py-20 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background-image: url('data:image/svg+xml,<svg width=" 60" height="60" viewBox="0 0 60 60"
                xmlns="http://www.w3.org/2000/svg">
                <g fill="none" fill-rule="evenodd">
                    <g fill="%23000000" fill-opacity="0.1">
                        <circle cx="30" cy="30" r="2" />
                    </g></svg>')">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header with Animation -->
            <div class="text-center mb-16 animate-fade-in-up">
                <div class="inline-block">
                    <span
                        class="text-sm font-semibold text-indigo-600 uppercase tracking-wider bg-indigo-100 px-4 py-2 rounded-full">
                        Featured Collection
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mt-6 mb-4">
                    Our <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Best
                        Sellers</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Discover our most popular and highly-rated products, carefully selected for quality and value.
                </p>
            </div>

            <!-- Products Grid with Staggered Animation -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($featuredProducts as $index => $product)
                <div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-up"
                    style="animation-delay: {{ $index * 100 }}ms">

                    <!-- Product Image with Hover Effect -->
                    <div class="relative overflow-hidden">
                        @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div
                            class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        @endif

                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="bg-white text-indigo-600 px-6 py-2 rounded-full font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Quick View
                            </a>
                        </div>

                        <!-- Stock Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">
                                {{ $product->stock }} in stock
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <h3
                            class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors duration-300">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($product->description, 80) }}
                        </p>

                        <!-- Price and Rating -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-2xl font-bold text-indigo-600">{{ $product->formatted_price }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <div class="flex text-yellow-400">
                                    @for($i = 0; $i < 5; $i++) <svg class="w-4 h-4" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                        </svg>
                                        @endfor
                                </div>
                                <span class="text-sm text-gray-500">(4.8)</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-auto space-y-3">
                            <!-- Add to Cart Button -->
                            @auth
                            <form action="{{ route('cart.add') }}" method="POST" class="w-full add-to-cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    class="group/cart w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-4 rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
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
                            </form>
                            @else
                            <a href="{{ route('login') }}"
                                class="group/cart w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-4 rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-center block">
                                <span class="flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2 group-hover/cart:scale-110 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                        </path>
                                    </svg>
                                    Login to Add to Cart
                                </span>
                            </a>
                            @endauth

                            <!-- View Details Button -->
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="group/btn w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-4 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 text-center block transform hover:scale-105 hover:shadow-lg">
                                <span class="flex items-center justify-center">
                                    View Details
                                    <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16 animate-fade-in-up">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Featured Products</h3>
                    <p class="text-gray-500 text-lg">Check back soon for our featured collection!</p>
                </div>
                @endforelse
            </div>

            <!-- CTA Button with Animation -->
            <div class="text-center mt-16 animate-fade-in-up animation-delay-1000">
                <a href="{{ route('products.index') }}"
                    class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <span class="relative z-10">Explore All Products</span>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-indigo-50 relative overflow-hidden">
        <!-- Background Decoration -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-indigo-200 to-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-pink-200 to-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16 animate-fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Why Choose <span
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Us?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    We're committed to providing you with the best shopping experience possible.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-up">
                    <div class="relative mb-6">
                        <div
                            class="bg-gradient-to-br from-indigo-500 to-purple-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <!-- Floating Animation -->
                        <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-400 rounded-full animate-ping"></div>
                    </div>
                    <h3
                        class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-indigo-600 transition-colors duration-300">
                        Free Shipping
                    </h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Enjoy free shipping on all orders over $100. No hidden fees, no surprises.
                    </p>
                    <div class="mt-4 text-sm text-indigo-600 font-semibold">
                        ✓ Orders over $100
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-up animation-delay-200">
                    <div class="relative mb-6">
                        <div
                            class="bg-gradient-to-br from-green-500 to-emerald-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <!-- Floating Animation -->
                        <div
                            class="absolute -top-2 -right-2 w-4 h-4 bg-green-400 rounded-full animate-ping animation-delay-1000">
                        </div>
                    </div>
                    <h3
                        class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-green-600 transition-colors duration-300">
                        Quality Guarantee
                    </h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Not satisfied? Return any item within 30 days for a full refund, no questions asked.
                    </p>
                    <div class="mt-4 text-sm text-green-600 font-semibold">
                        ✓ 30-day guarantee
                    </div>
                </div>

                <!-- Feature 3 -->
                <div
                    class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 animate-fade-in-up animation-delay-400">
                    <div class="relative mb-6">
                        <div
                            class="bg-gradient-to-br from-orange-500 to-red-600 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <!-- Floating Animation -->
                        <div
                            class="absolute -top-2 -right-2 w-4 h-4 bg-orange-400 rounded-full animate-ping animation-delay-2000">
                        </div>
                    </div>
                    <h3
                        class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors duration-300">
                        Lightning Fast
                    </h3>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Get your orders delivered the same day in select areas. Fast, reliable, and secure.
                    </p>
                    <div class="mt-4 text-sm text-orange-600 font-semibold">
                        ✓ Same-day delivery
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-600 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=" 40" height="40"
                viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <g fill="%23ffffff" fill-opacity="0.1">
                    <path d="M20 20c0-11.046-8.954-20-20-20v20h20z" />
                </g></svg>')">
            </div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 animate-fade-in-up">
                Stay in the Loop
            </h2>
            <p class="text-xl mb-8 animate-fade-in-up animation-delay-200">
                Get exclusive deals, new product alerts, and special offers delivered to your inbox.
            </p>

            <div class="max-w-md mx-auto animate-fade-in-up animation-delay-400">
                <div class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Enter your email address"
                        class="flex-1 px-6 py-4 rounded-full text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button
                        class="bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition-colors duration-300 transform hover:scale-105">
                        Subscribe
                    </button>
                </div>
                <p class="text-sm text-indigo-200 mt-4">
                    No spam, unsubscribe at any time.
                </p>
            </div>
        </div>
    </section>
</div>

<!-- Custom CSS for Animations -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    @keyframes gradient-x {

        0%,
        100% {
            background-size: 200% 200%;
            background-position: left center;
        }

        50% {
            background-size: 200% 200%;
            background-position: right center;
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animate-gradient-x {
        animation: gradient-x 3s ease infinite;
        background-size: 200% 200%;
    }

    .animation-delay-200 {
        animation-delay: 0.2s;
    }

    .animation-delay-400 {
        animation-delay: 0.4s;
    }

    .animation-delay-500 {
        animation-delay: 0.5s;
    }

    .animation-delay-1000 {
        animation-delay: 1s;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-3000 {
        animation-delay: 3s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>

<!-- JavaScript for Typewriter Effect and Cart Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Typewriter effect
        const typewriterElement = document.getElementById('typewriter');
        if (typewriterElement) {
            const text = typewriterElement.textContent;
            typewriterElement.textContent = '';
            typewriterElement.style.opacity = '1';

            let i = 0;
            const typeWriter = () => {
                if (i < text.length) {
                    typewriterElement.textContent += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            };

            setTimeout(typeWriter, 1000);
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.querySelectorAll('.animate-fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            observer.observe(el);
        });

        // Add to Cart functionality
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const button = this.querySelector('button[type="submit"]');
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

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
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

                        // Update cart count if element exists
                        updateCartCount();

                        // Show notification
                        showNotification('Product added to cart successfully!', 'success');

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
            });
        });
    });

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
@endsection
