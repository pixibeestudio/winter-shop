<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Winter Jacket Store')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-gray-800 antialiased overflow-x-hidden flex flex-col min-h-screen">

    @include('partials.header')

    <main class="flex-grow pt-20"> 
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
    
    <div id="cartOverlay" class="fixed inset-0 z-[60] hidden">
        
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity opacity-0" 
             id="cartBackdrop"
             onclick="toggleCart(false)"></div>

        <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col"
             id="cartPanel">
            
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                <h2 class="text-lg font-bold text-gray-900">Shopping Cart</h2>
                <button onclick="toggleCart(false)" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div id="cartContent" class="flex flex-col h-full">
        {{-- Mặc định load lần đầu --}}
        @include('partials.cart-sidebar', ['cart' => session()->get('cart', []), 'total' => 0])
    </div>

            <div class="flex-1 overflow-y-auto p-6 space-y-6">
                
                <div class="flex gap-4">
                    <div class="w-20 h-24 bg-gray-50 rounded-lg overflow-hidden border border-gray-100">
                        <img src="https://pngimg.com/d/jacket_PNG8038.png" class="w-full h-full object-contain p-1">
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start">
                                <h3 class="font-semibold text-gray-900 line-clamp-1">Premium Thermal Puffer</h3>
                                <p class="font-bold text-gray-900">$150.00</p>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Green / M</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center border border-gray-200 rounded-full px-2 py-1 gap-3">
                                <button class="text-gray-400 hover:text-black text-xs">-</button>
                                <span class="text-sm font-medium w-4 text-center">1</span>
                                <button class="text-gray-400 hover:text-black text-xs">+</button>
                            </div>
                            <button class="text-red-400 hover:text-red-600 text-xs underline decoration-dotted">Remove</button>
                        </div>
                    </div>
                </div>

                 <div class="flex gap-4 opacity-50">
                    <div class="w-20 h-24 bg-gray-50 rounded-lg overflow-hidden border border-gray-100">
                         <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">IMG</div>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">Another Item</h3>
                        <p class="text-sm text-gray-500">Black / L</p>
                        <p class="font-bold text-gray-900 mt-2">$89.00</p>
                    </div>
                </div>

            </div>

            <div class="border-t border-gray-100 p-6 bg-gray-50">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-500">Subtotal</span>
                    <span class="font-bold text-xl text-brand-dark">$239.00</span>
                </div>
                <p class="text-xs text-gray-400 mb-6 text-center">Shipping & taxes calculated at checkout.</p>
                <div class="space-y-3">
                    <button class="w-full bg-brand-dark text-white py-3.5 rounded-full font-bold shadow-lg hover:bg-black transition-all">
                        Checkout Now
                    </button>
                    <button class="w-full bg-white border border-gray-300 text-gray-700 py-3.5 rounded-full font-bold hover:bg-gray-50 transition-all">
                        View Cart
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleCart(show) {
            const overlay = document.getElementById('cartOverlay');
            const backdrop = document.getElementById('cartBackdrop');
            const panel = document.getElementById('cartPanel');

            if (show) {
                // 1. Hiện overlay
                overlay.classList.remove('hidden');
                // 2. Chờ 1 chút để browser render rồi mới chạy animation (Fade in / Slide in)
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('translate-x-full');
                }, 10);
            } else {
                // 1. Chạy animation đóng trước
                backdrop.classList.add('opacity-0');
                panel.classList.add('translate-x-full');
                
                // 2. Chờ animation chạy xong (300ms) rồi mới ẩn div
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }

        function removeFromCart(key) {
        if(!confirm('Remove this item?')) return;

        fetch('{{ route('cart.remove') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ key: key })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Cập nhật lại HTML giỏ hàng
                document.getElementById('cartContent').innerHTML = data.cart_html;
            }
        });
    }
    </script>

</body>
</html>