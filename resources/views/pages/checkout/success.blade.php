@extends('layouts.app')

@section('title', 'Order Success - Winter Store')

@section('content')
<div class="bg-gray-50 min-h-[80vh] flex items-center justify-center py-20">
    <div class="bg-white p-10 md:p-16 rounded-3xl shadow-xl text-center max-w-lg w-full mx-4 border border-gray-100">
        
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-slow">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">Thank You!</h1>
        <p class="text-gray-500 mb-8">Your order has been placed successfully.</p>

        <div class="bg-gray-50 rounded-xl p-6 mb-8 text-left border border-gray-100">
            <div class="flex justify-between mb-2">
                <span class="text-gray-500 text-sm">Order Number:</span>
                <span class="font-bold text-gray-900">#{{ $order->id ?? '0000' }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-500 text-sm">Date:</span>
                <span class="font-medium text-gray-900">{{ date('M d, Y') }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-500 text-sm">Total:</span>
                <span class="font-bold text-brand-dark">${{ number_format($order->total_amount ?? 0, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Payment Method:</span>
                <span class="font-medium text-gray-900 uppercase">{{ $order->payment_method ?? 'COD' }}</span>
            </div>
        </div>

        <p class="text-sm text-gray-400 mb-8">We have sent an email confirmation to <br> <span class="text-gray-600 font-medium">{{ $order->email ?? 'your email' }}</span></p>

        <div class="space-y-3">
            <a href="/" class="block w-full bg-brand-dark text-white py-3.5 rounded-full font-bold shadow-lg hover:bg-black transition-all">
                Continue Shopping
            </a>
            <a href="#" class="block w-full bg-white border border-gray-200 text-gray-700 py-3.5 rounded-full font-bold hover:bg-gray-50 transition-all">
                Track My Order
            </a>
        </div>
    </div>
</div>
@endsection