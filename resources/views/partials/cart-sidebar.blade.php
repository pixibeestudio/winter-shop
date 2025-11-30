<div class="flex-1 overflow-y-auto p-6 space-y-6">
    {{-- KIỂM TRA: NẾU CÓ HÀNG --}}
    @if (count($cart) > 0)
        @foreach ($cart as $key => $item)
            <div class="flex gap-4 animate-fade-in group">
                <div class="w-20 h-24 bg-gray-50 rounded-lg overflow-hidden border border-gray-100 shrink-0">
                    <img src="{{ $item['image'] ?? 'https://via.placeholder.com/80' }}"
                        class="w-full h-full object-contain p-1 mix-blend-multiply">
                </div>

                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-gray-900 line-clamp-1 pr-2">{{ $item['name'] }}</h3>
                            <p class="font-bold text-gray-900">${{ number_format($item['price'], 2) }}</p>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $item['color'] }} / {{ $item['size'] }}</p>
                    </div>

                    <div class="flex justify-between items-center mt-2">
                        <div
                            class="flex items-center bg-gray-50 border border-gray-200 rounded-full px-2 py-0.5 gap-2 text-xs">
                            <span class="text-gray-500">Qty:</span>
                            <span class="font-bold">{{ $item['quantity'] }}</span>
                        </div>

                        <button onclick="openDeleteModal('{{ $key }}')"
                            class="text-gray-400 hover:text-red-500 text-xs font-medium transition-colors flex items-center gap-1 py-1 px-2 rounded-md hover:bg-red-50">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- KIỂM TRA: NẾU GIỎ HÀNG RỖNG --}}
    @else
        <div class="h-full flex flex-col items-center justify-center text-center space-y-4">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-2">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Your cart is empty</h3>
                <p class="text-gray-500 text-sm mt-1 max-w-[200px] mx-auto">Looks like you haven't added anything to
                    your cart yet.</p>
            </div>
            <button onclick="toggleCart(false)"
                class="mt-4 bg-brand-dark text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all text-sm">
                Start Shopping
            </button>
        </div>
    @endif
</div>

@if (count($cart) > 0)
    <div class="border-t border-gray-100 p-6 bg-gray-50 z-20">
        <div class="flex justify-between items-center mb-4">
            <span class="text-gray-500">Subtotal</span>
            <span class="font-bold text-2xl text-brand-dark">${{ number_format($total, 2) }}</span>
        </div>
        <p class="text-xs text-gray-400 mb-6 text-center">Tax included and shipping calculated at checkout</p>
        <div class="space-y-3">
            <a href="{{ route('checkout.index') }}"
                class="w-full bg-brand-dark text-white py-4 rounded-full font-bold shadow-lg hover:bg-black transition-all flex justify-center items-center gap-2 group">
                Checkout Now
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
            <button onclick="toggleCart(false)"
                class="w-full bg-white border border-gray-200 text-gray-700 py-3.5 rounded-full font-bold hover:bg-gray-50 transition-all">
                Continue Shopping
            </button>
        </div>
    </div>
@endif
