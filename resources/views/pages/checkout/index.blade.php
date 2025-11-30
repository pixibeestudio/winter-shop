@extends('layouts.app')

@section('title', 'Checkout - Winter Store')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-20">
        <div class="container mx-auto px-6 pt-10">

            <div class="mb-6">
                {{-- 1. Nếu có lỗi Validate (Ví dụ: chưa nhập tên, email sai...) --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Please fix the following errors:</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 2. Nếu có lỗi hệ thống (Database lỗi, Code lỗi...) --}}
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">System Error:</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-center mb-10">
                <h1 class="text-3xl font-bold text-brand-dark">Checkout</h1>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST"
                class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                @csrf

                <div class="lg:col-span-7 space-y-8">

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span
                                class="w-8 h-8 rounded-full bg-brand-dark text-white flex items-center justify-center text-sm">1</span>
                            Contact Information
                        </h2>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-dark focus:border-brand-dark transition-all"
                                    placeholder="you@example.com">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span
                                class="w-8 h-8 rounded-full bg-brand-dark text-white flex items-center justify-center text-sm">2</span>
                            Shipping Address
                        </h2>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="full_name"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-dark focus:border-brand-dark transition-all">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <input type="text" name="address"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-dark focus:border-brand-dark transition-all"
                                    placeholder="123 Street Name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-dark focus:border-brand-dark transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input type="text" name="city"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-dark focus:border-brand-dark transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span
                                class="w-8 h-8 rounded-full bg-brand-dark text-white flex items-center justify-center text-sm">3</span>
                            Payment Method
                        </h2>

                        <div class="space-y-4">
                            <label
                                class="flex items-center p-4 border rounded-xl cursor-pointer hover:border-brand-dark hover:bg-gray-50 transition-all group">
                                <input type="radio" name="payment_method" value="cod" checked
                                    class="w-5 h-5 text-brand-dark focus:ring-brand-dark border-gray-300">
                                <div class="ml-4 flex-1">
                                    <span class="block font-bold text-gray-900">Cash on Delivery (COD)</span>
                                    <span class="block text-sm text-gray-500">Pay when you receive the package.</span>
                                </div>
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-brand-dark" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </label>

                            <label
                                class="flex items-center p-4 border rounded-xl cursor-pointer hover:border-brand-dark hover:bg-gray-50 transition-all group">
                                <input type="radio" name="payment_method" value="bank"
                                    class="w-5 h-5 text-brand-dark focus:ring-brand-dark border-gray-300">
                                <div class="ml-4 flex-1">
                                    <span class="block font-bold text-gray-900">Bank Transfer</span>
                                    <span class="block text-sm text-gray-500">Fast and secure bank transfer.</span>
                                </div>
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-brand-dark" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-5">
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 lg:sticky lg:top-24">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                        <div class="space-y-4 max-h-80 overflow-y-auto pr-2 mb-6 custom-scrollbar">
                            @foreach ($cart as $item)
                                <div class="flex gap-4 items-center">
                                    <div
                                        class="w-16 h-20 bg-gray-50 rounded-lg overflow-hidden border border-gray-200 shrink-0">
                                        <img src="{{ $item['image'] }}"
                                            class="w-full h-full object-contain mix-blend-multiply">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 text-sm line-clamp-1">{{ $item['name'] }}</h3>
                                        <p class="text-xs text-gray-500">{{ $item['color'] }} / {{ $item['size'] }}</p>
                                        <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <div class="font-bold text-gray-900 text-sm">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex gap-2 mb-6">
                            <input type="text" placeholder="Discount code"
                                class="flex-1 px-4 py-2 border rounded-lg text-sm focus:ring-brand-dark focus:border-brand-dark">
                            <button type="button"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold hover:bg-gray-300 transition-colors">Apply</button>
                        </div>

                        <div class="border-t border-gray-100 pt-4 space-y-2 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span class="font-medium text-gray-900">${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Shipping</span>
                                <span class="text-green-600 font-medium">Free</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mt-4 flex justify-between items-center">
                            <span class="font-bold text-lg text-gray-900">Total</span>
                            <div class="text-right">
                                <span class="text-xs text-gray-500 block mb-1">USD</span>
                                <span class="font-bold text-2xl text-brand-dark">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-brand-dark text-white py-4 rounded-xl font-bold text-lg shadow-xl shadow-brand-dark/20 hover:shadow-2xl hover:-translate-y-1 transition-all mt-8">
                            Confirm Order
                        </button>

                        <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-2">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            Secure Encrypted Checkout
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
