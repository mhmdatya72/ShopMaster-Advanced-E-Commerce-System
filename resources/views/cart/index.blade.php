@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
@php
$currencySymbol = $cart->currency_symbol ?? '$';
$currencyCode = $cart->currency_code ?? 'USD';
@endphp

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Modern Header -->
        <div class="text-center mb-12">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                    </path>
                </svg>
            </div>
            <h1
                class="text-4xl font-bold bg-gradient-to-r from-gray-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent mb-2">
                Shopping Cart</h1>
            <p class="text-gray-600 text-lg">Review your items and proceed to checkout</p>
        </div>

        @if($cart->cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" id="cart-root" data-currency-symbol="{{ $currencySymbol }}"
            data-currency-code="{{ $currencyCode }}">
            <!-- Cart Items -->
            <div class="lg:col-span-2" id="cart-items-col">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                    <div
                        class="px-8 py-6 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-t-2xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Your Items</h2>
                                    <p class="text-sm text-gray-600"><span id="cart-items-count">{{ $cart->total_items
                                            }}</span> items in your cart</p>
                                </div>
                            </div>
                            <div class="px-4 py-2 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full">
                                <span class="text-sm font-semibold text-indigo-700">Total: <span id="header-total"
                                        class="text-lg">{{ $cart->formatted_subtotal ?? $currencySymbol . '0.00'
                                        }}</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-100" id="cart-items-list">
                        @foreach($cart->cartItems as $item)
                        <div class="p-8 hover:bg-gradient-to-r hover:from-indigo-50/50 hover:to-purple-50/50 transition-all duration-300"
                            id="cart-item-{{ $item->id }}" data-item-id="{{ $item->id }}"
                            data-product-id="{{ $item->product_id }}"
                            data-unit-price="{{ $item->price ?? $item->unit_price ?? 0 }}"
                            data-max-qty="{{ $item->product->stock ?? 999 }}"
                            data-currency-symbol="{{ $currencySymbol }}" data-currency-code="{{ $currencyCode }}">
                            <div class="flex items-center gap-6">
                                @if($item->product->image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product->name }}"
                                        class="w-24 h-24 object-cover rounded-2xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                </div>
                                @else
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold text-gray-900 truncate mb-2">{{ $item->product->name }}
                                    </h3>
                                    <div class="flex items-center space-x-4 mb-3">
                                        <span
                                            class="px-3 py-1 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-700 text-sm font-medium rounded-full">
                                            {{ optional($item->product->category)->name ?? 'General' }}
                                        </span>
                                        <span class="text-sm text-gray-500">Stock: {{ $item->product->stock ?? 999
                                            }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-600">Unit price:</span>
                                        <span class="text-lg font-bold text-indigo-600 per-unit"
                                            id="per-unit-{{ $item->id }}">{{ $item->formatted_price }}</span>
                                    </div>
                                </div>

                                <div class="flex flex-col items-center space-y-4">
                                    <!-- Quick quantity controls -->
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="updateQuantity({{ $item->id }}, 1)"
                                            class="px-4 py-2 text-sm font-semibold bg-gradient-to-r from-red-500 to-pink-500 text-white hover:from-red-600 hover:to-pink-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            id="min-btn-{{ $item->id }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}
                                                title="Set to minimum (1)">
                                                Min
                                        </button>
                                        <button type="button"
                                            onclick="updateQuantity({{ $item->id }}, {{ $item->product->stock ?? 999 }})"
                                            class="px-4 py-2 text-sm font-semibold bg-gradient-to-r from-green-500 to-emerald-500 text-white hover:from-green-600 hover:to-emerald-600 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 {{ $item->quantity >= ($item->product->stock ?? 999) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            id="max-btn-{{ $item->id }}" {{ $item->quantity >= ($item->product->stock ??
                                            999) ? 'disabled' : '' }}
                                            title="Set to maximum ({{ $item->product->stock ?? 999 }})">
                                            Max
                                        </button>
                                    </div>

                                    <div
                                        class="flex items-center gap-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-2">
                                        <button type="button" aria-label="Decrease quantity"
                                            onclick="decreaseQuantity({{ $item->id }})"
                                            class="w-10 h-10 rounded-xl bg-gradient-to-r from-red-500 to-pink-500 text-white flex items-center justify-center hover:from-red-600 hover:to-pink-600 transition-all duration-200 transform hover:scale-110 shadow-lg {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            id="decrease-btn-{{ $item->id }}" {{ $item->quantity <= 1 ? 'disabled' : ''
                                                }}>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                        </button>

                                        <div class="min-w-[60px] text-center">
                                            <span id="quantity-{{ $item->id }}"
                                                class="text-2xl font-bold text-gray-900 select-none">{{ $item->quantity
                                                }}</span>
                                        </div>

                                        <button type="button" aria-label="Increase quantity"
                                            onclick="increaseQuantity({{ $item->id }})"
                                            class="w-10 h-10 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 text-white flex items-center justify-center hover:from-green-600 hover:to-emerald-600 transition-all duration-200 transform hover:scale-110 shadow-lg {{ $item->quantity >= ($item->product->stock ?? 999) ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            id="increase-btn-{{ $item->id }}"
                                            data-max-quantity="{{ $item->product->stock ?? 999 }}" {{ $item->quantity >=
                                            ($item->product->stock ?? 999) ? 'disabled' : '' }}>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v12M6 12h12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Stock info -->
                                    <div class="text-xs text-gray-500 mt-2">
                                        <span id="stock-info-{{ $item->id }}"
                                            class="px-2 py-1 bg-gray-100 rounded-full">Max: {{ $item->product->stock ??
                                            999 }}</span>
                                    </div>
                                </div>

                                <div class="text-right min-w-[160px]">
                                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-4 shadow-lg">
                                        <p class="text-2xl font-bold text-indigo-600 mb-2" id="total-{{ $item->id }}">
                                            {{ $item->formatted_total }}
                                        </p>
                                        <button type="button" onclick="removeItem({{ $item->id }})"
                                            class="w-full px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-semibold rounded-xl hover:from-red-600 hover:to-pink-600 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1" id="order-summary-col">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 p-8 sticky top-8"
                    id="summary-card" data-currency-symbol="{{ $currencySymbol }}"
                    data-currency-code="{{ $currencyCode }}">
                    <div class="text-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2
                            class="text-2xl font-bold bg-gradient-to-r from-gray-900 to-indigo-900 bg-clip-text text-transparent mb-2">
                            Order Summary</h2>
                        <p class="text-gray-600">Review your order details</p>
                    </div>

                    <!-- Coupon Code -->
                    <div class="mb-6">
                        <label for="coupon_code" class="block text-sm font-semibold text-gray-700 mb-3"> Coupon
                            Code</label>
                        <div class="flex gap-3">
                            <input type="text" id="coupon_code" placeholder="Enter your coupon code"
                                class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 bg-gray-50/50">
                            <button type="button" onclick="applyCoupon()" id="apply-coupon-btn"
                                class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                Apply
                            </button>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                            const couponInput = document.getElementById('coupon_code');
                            if (couponInput) {
                                couponInput.addEventListener('input', function() {
                                    const msg = document.getElementById('coupon-message');
                                    const val = this.value.trim();
                                    if (window.manager && window.manager.appliedCoupon && window.manager.appliedCoupon.code === val) {
                                        msg.textContent = 'This coupon is already applied to your cart';
                                        msg.className = 'mt-2 text-sm text-red-600';
                                    } else {
                                        msg.textContent = '';
                                        msg.className = 'mt-2 text-sm';
                                    }
                                });
                            }
                        });
                        </script>
                        <div id="coupon-message" class="mt-2 text-sm"></div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="mb-6">
                        <label for="shipping_method" class="block text-sm font-semibold text-gray-700 mb-3"> Shipping
                            Method</label>
                        <select id="shipping_method"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all duration-200 bg-gray-50/50">
                            <option value="">Select shipping method</option>
                            @foreach($shippingMethods as $method)
                            <option value="{{ $method->id }}" data-cost="{{ $method->cost ?? 0 }}" {{
                                session('selected_shipping_method')==$method->id ? 'selected' : '' }}>
                                {{ $method->name }} - {{ $method->formatted_cost }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Order Totals -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 text-center"> Price Breakdown</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Subtotal:</span>
                                <span id="subtotal" data-raw="{{ $cart->subtotal ?? 0 }}"
                                    class="text-lg font-bold text-gray-900">{{ $cart->formatted_subtotal }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Shipping:</span>
                                <span id="shipping-cost" class="text-lg font-bold text-gray-900">{{ $currencySymbol
                                    }}0.00</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-gray-600 font-medium">Discount:</span>
                                <span id="discount-amount" class="text-lg font-bold text-green-600">{{ $currencySymbol
                                    }}0.00</span>
                            </div>
                            <div class="border-t-2 border-gray-300 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-gray-900">Total:</span>
                                    <span id="total-amount"
                                        class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">{{
                                        $cart->formatted_subtotal ?? $currencySymbol . '0.00' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <a href="{{ route('checkout.index') }}"
                            class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-4 px-6 rounded-2xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 text-center block font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                            <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            Proceed to Checkout
                        </a>

                        <a href="{{ route('products.index') }}"
                            class="w-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-6 rounded-2xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 text-center block font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart -->
        <div id="empty-cart" class="text-center py-20">
            <div class="max-w-md mx-auto">
                <div
                    class="w-32 h-32 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-16 h-16 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                        </path>
                    </svg>
                </div>
                <h2
                    class="text-4xl font-bold bg-gradient-to-r from-gray-900 to-indigo-900 bg-clip-text text-transparent mb-4">
                    Your cart is empty</h2>
                <p class="text-gray-600 text-lg mb-10">Looks like you haven't added any items to your cart yet. Let's
                    find something amazing for you!</p>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold text-lg rounded-2xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    (() => {
    // ===== Utilities =====
    function getCsrf() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        if (meta?.content) return meta.content;
        const hidden = document.querySelector('input[name="_token"]');
        if (hidden?.value) return hidden.value;
        return window.Laravel?.csrfToken || '';
    }

    function currencyInfo(root = document.getElementById('cart-root')) {
        const sym = root?.dataset?.currencySymbol || document.getElementById('summary-card')?.dataset?.currencySymbol || '$';
        const code = root?.dataset?.currencyCode   || document.getElementById('summary-card')?.dataset?.currencyCode   || 'USD';
        return { symbol: sym, code };
    }

    function fmt(n, code, symbol) {
        try {
            const num = isNaN(Number(n)) ? 0 : Number(n);
            return new Intl.NumberFormat(undefined, { style: 'currency', currency: code, minimumFractionDigits: 2 }).format(num);
        } catch (_) {
            const num = isNaN(Number(n)) ? 0 : Number(n);
            return `${symbol}${num.toFixed(2)}`;
        }
    }

    function parsePrice(str) {
        if (typeof str === 'number') return str;
        if (!str) return 0;
        // اقبل أي فورمات: احذف أي شيء غير 0-9 . -
        const clean = String(str).replace(/[^0-9.\-]+/g, '');
        const val = parseFloat(clean);
        return isNaN(val) ? 0 : val;
    }

    // Debounce helper
    function debounce(fn, wait = 300) {
        let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), wait); };
    }

    // Notification
    function notify(msg, type='info') {
        const el = document.createElement('div');
        el.className = `fixed top-4 right-4 px-4 py-2 rounded-lg shadow z-50 text-white ${
            type==='success'?'bg-green-600':type==='error'?'bg-red-600':'bg-gray-800'
        }`;
        el.textContent = msg;
        document.body.appendChild(el);
        setTimeout(()=> el.remove(), 2500);
    }

    // ===== Cart Manager =====
    class CartManager {
        constructor() {
            this.csrf = getCsrf();
            this.busy = new Set(); // itemId currently updating
            this.appliedCoupon = null;
            this.bind();
            this.updateTotals(); // initial
        }

        bind() {
            // Shipping change
            const shippingSelect = document.getElementById('shipping_method');
            if (shippingSelect) {
                shippingSelect.addEventListener('change', () => this.updateShippingMethod());
            }
        }

        getItemEls(itemId) {
            const root = document.getElementById(`cart-item-${itemId}`);
            if (!root) return null;
            return {
                root,
                itemId,
                productId: root.dataset.productId,
                unitPrice: parsePrice(root.dataset.unitPrice),
                maxQty: parseInt(root.dataset.maxQty || '999'),
                qtyEl: document.getElementById(`quantity-${itemId}`),
                totalEl: document.getElementById(`total-${itemId}`),
                perUnitEl: document.getElementById(`per-unit-${itemId}`),
                decBtn: document.getElementById(`decrease-btn-${itemId}`),
                incBtn: document.getElementById(`increase-btn-${itemId}`),
                minBtn: document.getElementById(`min-btn-${itemId}`),
                maxBtn: document.getElementById(`max-btn-${itemId}`),
                stockInfo: document.getElementById(`stock-info-${itemId}`)
            };
        }

        setButtonsState(els, qty) {
            // Regular increment/decrement buttons
            if (els.decBtn) {
                els.decBtn.disabled = qty <= 1;
                els.decBtn.classList.toggle('opacity-50', qty <= 1);
                els.decBtn.classList.toggle('cursor-not-allowed', qty <= 1);
            }
            if (els.incBtn) {
                els.incBtn.disabled = qty >= els.maxQty;
                els.incBtn.classList.toggle('opacity-50', qty >= els.maxQty);
                els.incBtn.classList.toggle('cursor-not-allowed', qty >= els.maxQty);
            }

            // Min/Max buttons
            if (els.minBtn) {
                els.minBtn.disabled = qty <= 1;
                els.minBtn.classList.toggle('opacity-50', qty <= 1);
                els.minBtn.classList.toggle('cursor-not-allowed', qty <= 1);
            }
            if (els.maxBtn) {
                els.maxBtn.disabled = qty >= els.maxQty;
                els.maxBtn.classList.toggle('opacity-50', qty >= els.maxQty);
                els.maxBtn.classList.toggle('cursor-not-allowed', qty >= els.maxQty);
            }

            // Stock info
            if (els.stockInfo) {
                const left = Math.max(els.maxQty - qty, 0);
                let color = 'text-gray-500';
                if (left <= 2) color = 'text-red-500';
                else if (left <= 5) color = 'text-yellow-500';
                els.stockInfo.className = `text-xs ${color} mt-1`;
                els.stockInfo.textContent = `Max: ${els.maxQty} (${left} left)`;
            }
        }

        // Debounced update
        updateQuantity = debounce((itemId, newQty) => this._updateQuantity(itemId, newQty), 300);

        _updateQuantity(itemId, newQty) {
            console.log(`_updateQuantity called: itemId=${itemId}, newQty=${newQty}`);
            const els = this.getItemEls(itemId);
            if (!els) {
                console.log('No elements found for itemId:', itemId);
                return;
            }

            newQty = parseInt(newQty || '1');
            if (newQty < 1) {
                notify('Minimum quantity is 1', 'error');
                newQty = 1;
            }
            if (newQty > els.maxQty) {
                notify(`Maximum available is ${els.maxQty}`, 'error');
                newQty = els.maxQty;
            }

            const currentQty = parseInt(els.qtyEl.textContent || '1');
            if (newQty === currentQty) return;

            if (this.busy.has(itemId)) return;
            this.busy.add(itemId);

            // Show loading state
            els.qtyEl.textContent = '...';
            els.decBtn?.setAttribute('disabled','disabled');
            els.incBtn?.setAttribute('disabled','disabled');
            els.minBtn?.setAttribute('disabled','disabled');
            els.maxBtn?.setAttribute('disabled','disabled');

            fetch('/cart/update', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: els.productId,
                    quantity: newQty
                })
            })
            .then(r => {
                if (!r.ok) {
                    throw new Error(`HTTP ${r.status}: ${r.statusText}`);
                }
                return this.ensureJson(r);
            })
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message || 'Failed to update quantity');
                }

                // Update UI with server response
                els.qtyEl.textContent = newQty;

                // Update item total
                if (typeof data.item_total !== 'undefined') {
                    els.totalEl.textContent = data.item_total;
                } else {
                    const { code, symbol } = currencyInfo();
                    els.totalEl.textContent = fmt(els.unitPrice * newQty, code, symbol);
                }

                // Update unit price if changed
                if (typeof data.unit_price !== 'undefined' && els.perUnitEl) {
                    els.perUnitEl.textContent = data.unit_price;
                    els.unitPrice = parsePrice(data.unit_price);
                }

                // Update max quantity if changed
                if (typeof data.max_qty !== 'undefined') {
                    els.maxQty = parseInt(data.max_qty);
                    els.root.dataset.maxQty = els.maxQty;
                }

                // Update buttons state
                this.setButtonsState(els, newQty);

                // Update cart totals
                console.log('Calling updateTotals after quantity update');
                this.updateTotals();
                this.updateCartCount();

                notify('Quantity updated successfully', 'success');
            })
            .catch(err => {
                console.error('Update quantity error:', err);
                // Reset to original quantity
                els.qtyEl.textContent = currentQty;
                this.setButtonsState(els, currentQty);
                notify(err.message || 'Failed to update quantity', 'error');
            })
            .finally(() => {
                this.busy.delete(itemId);
            });
        }

        removeItem(itemId) {
            const els = this.getItemEls(itemId);
            if (!els) return;

            if (this.busy.has(itemId)) return;
            this.busy.add(itemId);

            fetch('/cart/remove', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: els.productId })
            })
            .then(r => this.ensureJson(r))
            .then(data => {
                if (!data.success) throw new Error(data.message || 'Failed to remove item');
                els.root.remove();
                this.updateItemsCountUI();
                this.updateTotals();
                this.updateCartCount();
                this.checkEmptyState();
                notify('Item removed', 'success');
            })
            .catch(err => notify(err.message || 'Error removing item', 'error'))
            .finally(() => this.busy.delete(itemId));
        }

        applyCoupon() {
            const codeInput = document.getElementById('coupon_code');
            const msg = document.getElementById('coupon-message');
            const btn = document.getElementById('apply-coupon-btn');
            const val = codeInput.value.trim();
            if (!val) {
                msg.textContent = 'Please enter a coupon code';
                msg.className = 'mt-2 text-sm text-red-600';
                return;
            }

            // Check if coupon is already applied
            if (this.appliedCoupon && this.appliedCoupon.code === val) {
                msg.textContent = 'This coupon is already applied to your cart';
                msg.className = 'mt-2 text-sm text-red-600';
                return;
            }

            btn.disabled = true;

            fetch('/cart/apply-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ code: val })
            })
            .then(r => this.ensureJson(r))
            .then(data => {
                if (!data.success) {
                    msg.textContent = data.message || 'Invalid coupon';
                    msg.className = 'mt-2 text-sm text-red-600';
                    this.appliedCoupon = null;
                    return;
                }
                this.appliedCoupon = data.coupon || true;
                msg.textContent = data.message || 'Coupon applied';
                msg.className = 'mt-2 text-sm text-green-600';
                this.updateTotals();
            })
            .catch(() => {
                msg.textContent = 'An error occurred';
                msg.className = 'mt-2 text-sm text-red-600';
            })
            .finally(() => { btn.disabled = false; });
        }

        updateShippingMethod() {
            const sel = document.getElementById('shipping_method');
            const id = sel?.value;
            // Optimistic totals refresh
            this.updateTotals(true);
            if (!id) return;

            fetch('/cart/update-shipping', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrf,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ shipping_method_id: id })
            })
            .then(r => this.ensureJson(r))
            .then(data => {
                if (!data.success) return;
                this.updateTotals();
            })
            .catch(() => {/*silent*/});
        }

        updateTotals(optimistic=false) {
            console.log('Updating totals...', { optimistic });
            const { code, symbol } = currencyInfo();

            fetch('/cart/totals', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.csrf,
                    'Cache-Control': 'no-cache'
                }
            })
            .then(r => {
                console.log('Totals response status:', r.status);
                if (!r.ok) {
                    throw new Error(`HTTP ${r.status}: ${r.statusText}`);
                }
                return this.ensureJson(r);
            })
            .then(data => {
                console.log('Totals data received:', data);
                if (!data.success || !data.totals) {
                    throw new Error('Invalid totals response');
                }
                this.renderTotals(data.totals, code, symbol);
            })
            .catch(err => {
                console.error('Totals update error:', err);
                if (optimistic) {
                    this.calculateFallbackTotals(code, symbol);
                } else {
                    notify('Failed to update totals', 'error');
                }
            });
        }

        renderTotals(t, code, symbol) {
            console.log('Rendering totals:', t, { code, symbol });
            const subEl = document.getElementById('subtotal');
            const shipEl= document.getElementById('shipping-cost');
            const taxEl = document.getElementById('tax-amount');
            const discEl= document.getElementById('discount-amount');
            const totEl = document.getElementById('total-amount');
            const headerTotEl = document.getElementById('header-total');

            if (typeof t.subtotal !== 'undefined' && !isNaN(t.subtotal)) {
                subEl.textContent = fmt(t.subtotal, code, symbol);
                console.log('Updated subtotal:', subEl.textContent);
            }
            if (typeof t.shipping !== 'undefined' && !isNaN(t.shipping)) {
                shipEl.textContent = fmt(t.shipping, code, symbol);
                console.log('Updated shipping:', shipEl.textContent);
            }
            if (typeof t.discount !== 'undefined' && !isNaN(t.discount)) {
                discEl.textContent = fmt(t.discount, code, symbol);
                console.log('Updated discount:', discEl.textContent);
            }
            if (typeof t.total !== 'undefined' && !isNaN(t.total)) {
                const totalFormatted = fmt(t.total, code, symbol);
                if (totEl) {
                    totEl.textContent = totalFormatted;
                    console.log('Updated main total:', totEl.textContent);
                }
                if (headerTotEl) {
                    headerTotEl.textContent = totalFormatted;
                    console.log('Updated header total:', headerTotEl.textContent);
                }
            }
        }

        calculateFallbackTotals(code, symbol) {
            const subEl = document.getElementById('subtotal');
            const sel = document.getElementById('shipping_method');
            const opt = sel?.selectedOptions?.[0];
            const shipping = parsePrice(opt?.dataset?.cost || 0);
            const subtotal = parsePrice(subEl?.textContent || 0);
            const discount = 0;
            const total = Math.max(0, (isNaN(subtotal) ? 0 : subtotal) + (isNaN(shipping) ? 0 : shipping) - discount);

            // Update both total elements directly
            const totEl = document.getElementById('total-amount');
            const headerTotEl = document.getElementById('header-total');
            const totalFormatted = fmt(total, code, symbol);

            if (totEl) totEl.textContent = totalFormatted;
            if (headerTotEl) headerTotEl.textContent = totalFormatted;

            this.renderTotals({
                subtotal: isNaN(subtotal) ? 0 : subtotal,
                shipping: isNaN(shipping) ? 0 : shipping,
                discount: 0,
                total: total
            }, code, symbol);
        }

        updateCartCount() {
            fetch('/cart/count', {
                method: 'GET',
                headers: { 'Accept':'application/json','X-CSRF-TOKEN': this.csrf }
            })
            .then(r => this.ensureJson(r))
            .then(data => {
                if (data.success && typeof data.count !== 'undefined') {
                    const badge = document.getElementById('cart-count');
                    if (badge) badge.textContent = String(data.count);
                }
            })
            .catch(()=>{});
        }

        updateItemsCountUI() {
            const list = document.getElementById('cart-items-list');
            const countEl = document.getElementById('cart-items-count');
            const items = list?.querySelectorAll('[id^="cart-item-"]') || [];
            if (countEl) countEl.textContent = String(items.length);
        }

        checkEmptyState() {
            const list = document.getElementById('cart-items-list');
            const hasItems = list?.querySelector('[id^="cart-item-"]');
            const itemsCol = document.getElementById('cart-items-col');
            const summaryCol = document.getElementById('order-summary-col');
            let empty = document.getElementById('empty-cart');

            if (!hasItems) {
                if (itemsCol) itemsCol.style.display = 'none';
                if (summaryCol) summaryCol.style.display = 'none';

                if (!empty) {
                    // Inject empty state if not present (happens when initial was non-empty)
                    const wrapper = document.createElement('div');
                    wrapper.id = 'empty-cart';
                    wrapper.className = 'text-center py-12';
                    wrapper.innerHTML = `
                        <div class="text-gray-400 mb-4">
                            <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
                        <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet.</p>
                        <a href="{{ route('products.index') }}"
                           class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 font-semibold">
                           Start Shopping
                        </a>`;
                    document.querySelector('.max-w-7xl')?.appendChild(wrapper);
                } else {
                    empty.style.display = 'block';
                }
            }
        }

        ensureJson(resp) {
            const ct = resp.headers.get('content-type') || '';
            if (!ct.includes('application/json')) throw new Error('Unexpected response');
            return resp.json();
        }
    }

    // Instantiate
    const manager = new CartManager();

    // Force update totals on page load
    setTimeout(() => {
        console.log('Force updating totals on page load');
        console.log('Cart subtotal from PHP:', {{ $cart->subtotal ?? 0 }});
        console.log('Cart formatted subtotal from PHP:', '{{ $cart->formatted_subtotal ?? "N/A" }}');
        manager.updateTotals();
    }, 100);

    // Expose required globals for existing inline handlers
    window.updateQuantity = (id, q) => {
        console.log(`Updating quantity for item ${id} to ${q}`);
        manager.updateQuantity(id, q);
    };

    window.increaseQuantity = (id) => {
        const els = manager.getItemEls(id);
        if (!els) return;
        const currentQty = parseInt(els.qtyEl.textContent || '1');
        const newQty = Math.min(currentQty + 1, els.maxQty);
        console.log(`Increasing quantity for item ${id} from ${currentQty} to ${newQty}`);
        manager.updateQuantity(id, newQty);
    };

    window.decreaseQuantity = (id) => {
        const els = manager.getItemEls(id);
        if (!els) return;
        const currentQty = parseInt(els.qtyEl.textContent || '1');
        const newQty = Math.max(currentQty - 1, 1);
        console.log(`Decreasing quantity for item ${id} from ${currentQty} to ${newQty}`);
        manager.updateQuantity(id, newQty);
    };

    window.removeItem = (id) => {
        console.log(`Removing item ${id}`);
        manager.removeItem(id);
    };
    window.applyCoupon = () => manager.applyCoupon();
    window.updateTotals = () => {
        console.log('Updating totals...');
        manager.updateTotals();
    };
    window.updateCartCount = () => manager.updateCartCount();
    window.checkIfCartIsEmpty = () => manager.checkEmptyState();
})();
</script>
@endpush
@endsection
