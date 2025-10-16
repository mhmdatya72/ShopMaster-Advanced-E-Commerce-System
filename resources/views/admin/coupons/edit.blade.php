@extends('admin.layouts.app')

@section('title', 'Edit Coupon')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Coupon: {{ $coupon->code }}</h1>
        <a href="{{ route('admin.coupons.index') }}"
            class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
            <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Back to Coupons
        </a>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Edit Coupon Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Coupon Code -->
                <div class="md:col-span-2">
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                        Coupon Code <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="code" name="code" value="{{ old('code', $coupon->code) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('code') border-red-500 @enderror"
                        placeholder="Enter coupon code" required>
                    @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                        placeholder="Enter coupon description">{{ old('description', $coupon->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Discount Type -->
                <div>
                    <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Discount Type <span class="text-red-500">*</span>
                    </label>
                    <select id="discount_type" name="discount_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('discount_type') border-red-500 @enderror"
                        required>
                        <option value="">Select discount type</option>
                        <option value="percent" {{ old('discount_type', $coupon->discount_type) == 'percent' ? 'selected' :
                            '' }}>Percentage</option>
                        <option value="fixed" {{ old('discount_type', $coupon->discount_type) == 'fixed' ? 'selected' : ''
                            }}>Fixed Amount</option>
                    </select>
                    @error('discount_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Discount Value -->
                <div>
                    <label for="discount_value" class="block text-sm font-medium text-gray-700 mb-2">
                        Discount Value <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" id="discount_value" name="discount_value"
                            value="{{ old('discount_value', $coupon->discount_value) }}" step="0.01" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('discount_value') border-red-500 @enderror"
                            placeholder="Enter discount value" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span id="discount-suffix" class="text-gray-500 sm:text-sm">
                                {{ old('discount_type', $coupon->discount_type) == 'percent' ? '%' : '$' }}
                            </span>
                        </div>
                    </div>
                    @error('discount_value')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Minimum Order Value -->
                <div>
                    <label for="min_order_value" class="block text-sm font-medium text-gray-700 mb-2">
                        Minimum Order Value
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" id="min_order_value" name="min_order_value"
                            value="{{ old('min_order_value', $coupon->min_order_value) }}" step="0.01" min="0"
                            class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('min_order_value') border-red-500 @enderror"
                            placeholder="0.00">
                    </div>
                    @error('min_order_value')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Maximum Uses -->
                <div>
                    <label for="max_uses" class="block text-sm font-medium text-gray-700 mb-2">
                        Maximum Uses
                    </label>
                    <input type="number" id="max_uses" name="max_uses"
                        value="{{ old('max_uses', $coupon->max_uses) }}" min="1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('max_uses') border-red-500 @enderror"
                        placeholder="Leave empty for unlimited">
                    @error('max_uses')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expires At -->
                <div>
                    <label for="expires_at" class="block text-sm font-medium text-gray-700 mb-2">
                        Expires At
                    </label>
                    <input type="datetime-local" id="expires_at" name="expires_at"
                        value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('expires_at') border-red-500 @enderror">
                    @error('expires_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Is Active -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active',
                            $coupon->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Active (coupon can be used)
                        </label>
                    </div>
                </div>

                <!-- Usage Statistics -->
                <div class="md:col-span-2">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Usage Statistics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Total Uses</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $coupon->used_count ?? 0 }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Usage Limit</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $coupon->max_uses ?: 'Unlimited' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Remaining</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ $coupon->max_uses ? ($coupon->max_uses - ($coupon->used_count ?? 0)) :
                                    'Unlimited' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.coupons.index') }}"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition duration-300">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-300">
                    Update Coupon
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Update discount suffix based on type
document.getElementById('discount_type').addEventListener('change', function() {
    const suffix = document.getElementById('discount-suffix');
    if (this.value === 'percent') {
        suffix.textContent = '%';
    } else if (this.value === 'fixed') {
        suffix.textContent = '$';
    }
});
</script>
@endsection
