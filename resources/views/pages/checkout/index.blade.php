@extends('layouts.app')

@section('title', 'Checkout - Winter Store')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20 pt-10">
    <div class="container mx-auto px-6">
        
        <div class="flex items-center justify-center mb-10">
            <h1 class="text-3xl font-bold text-brand-dark">Secure Checkout</h1>
        </div>

        <div class="max-w-4xl mx-auto mb-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Please fix the following errors:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start max-w-6xl mx-auto">
            @csrf
            
            <div class="lg:col-span-7 space-y-6">
                
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">1</span>
                        Contact Information
                    </h2>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ auth()->user()->email ?? old('email') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all" placeholder="you@example.com" required>
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">2</span>
                        Shipping Address
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="full_name" value="{{ auth()->user()->name ?? old('full_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Address <span class="text-red-500">*</span></label>
                            <input type="text" name="address" value="{{ old('address') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all" placeholder="123 Street Name" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" value="{{ auth()->user()->phone ?? old('phone') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" value="{{ old('city') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all" required>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center text-sm font-bold">3</span>
                        Payment Method
                    </h2>
                    
                    <div class="space-y-4">
                        <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:border-black hover:bg-gray-50 transition-all group has-[:checked]:border-black has-[:checked]:bg-gray-50">
                            <input type="radio" name="payment_method" value="cod" checked class="w-5 h-5 text-black focus:ring-black border-gray-300">
                            <div class="ml-4 flex-1">
                                <span class="block font-bold text-gray-900">Cash on Delivery (COD)</span>
                                <span class="block text-xs text-gray-500">Pay locally when you receive the package.</span>
                            </div>
                            <svg class="w-6 h-6 text-gray-400 group-has-[:checked]:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </label>

                        <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:border-black hover:bg-gray-50 transition-all group has-[:checked]:border-black has-[:checked]:bg-gray-50">
                            <input type="radio" name="payment_method" value="bank" class="w-5 h-5 text-black focus:ring-black border-gray-300">
                            <div class="ml-4 flex-1">
                                <span class="block font-bold text-gray-900">Direct Bank Transfer</span>
                                <span class="block text-xs text-gray-500">Fast and secure transfer to our bank account.</span>
                            </div>
                            <svg class="w-6 h-6 text-gray-400 group-has-[:checked]:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </label>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-5">
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-lg border border-gray-100 lg:sticky lg:top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                    <div class="space-y-4 max-h-96 overflow-y-auto pr-2 custom-scrollbar mb-6">
                        @foreach($cart as $item)
                        <div class="flex gap-4 items-center py-2 border-b border-gray-50 last:border-0">
                            <div class="w-16 h-20 bg-gray-50 rounded-md overflow-hidden border border-gray-100 shrink-0">
                                <img src="{{ $item['image'] }}" class="w-full h-full object-contain mix-blend-multiply">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 text-sm line-clamp-2">{{ $item['name'] }}</h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $item['color'] }} / {{ $item['size'] }}</p>
                                <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <div class="font-bold text-gray-900 text-sm">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span class="text-green-600 font-bold">Free</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mt-4 flex justify-between items-end">
                        <span class="font-bold text-lg text-gray-900">Total</span>
                        <div class="text-right">
                            <span class="text-xs text-gray-500 block mb-1">USD</span>
                            <span class="font-bold text-3xl text-black">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-black text-white py-4 rounded-full font-bold text-lg shadow-xl hover:bg-gray-800 hover:shadow-2xl hover:-translate-y-1 transition-all mt-8 uppercase tracking-wider">
                        Confirm Order
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        SSL Secured Payment
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection