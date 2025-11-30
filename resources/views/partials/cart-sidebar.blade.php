<div class="flex-1 overflow-y-auto p-6 space-y-6">
    @if (count($cart) > 0)
        @foreach ($cart as $key => $item)
            <div class="flex gap-4 animate-fade-in">
                <div class="w-20 h-24 bg-gray-50 rounded-lg overflow-hidden border border-gray-100 shrink-0">
                    <img src="{{ $item['image'] }}" class="w-full h-full object-contain p-1">
                </div>
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start">
                            <h3 class="font-semibold text-gray-900 line-clamp-1">{{ $item['name'] }}</h3>
                            <p class="font-bold text-gray-900">${{ number_format($item['price'], 2) }}</p>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">{{ $item['color'] }} / {{ $item['size'] }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</span>

                        <button onclick="openDeleteModal('{{ $key }}')"
                            class="text-red-400 hover:text-red-600 text-xs font-medium hover:underline transition-colors flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    @else
        <div class="h-full flex flex-col items-center justify-center text-gray-400">
            <svg class="w-16 h-16 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <p>Your cart is empty.</p>
            <button onclick="toggleCart(false)" class="mt-4 text-brand-dark font-semibold hover:underline">Start
                Shopping</button>
        </div>
    @endif
</div>

<div class="border-t border-gray-100 p-6 bg-gray-50">
    <div class="flex justify-between items-center mb-4">
        <span class="text-gray-500">Subtotal</span>
        <span class="font-bold text-xl text-brand-dark">${{ number_format($total, 2) }}</span>
    </div>
    <div class="space-y-3">
        @if (count($cart) > 0)
            <button
                class="w-full bg-brand-dark text-white py-3.5 rounded-full font-bold shadow-lg hover:bg-black transition-all">
                Checkout Now
            </button>
        @else
            <button disabled class="w-full bg-gray-300 text-white py-3.5 rounded-full font-bold cursor-not-allowed">
                Checkout Now
            </button>
        @endif
    </div>
</div>
