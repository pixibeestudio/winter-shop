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

    <div id="cartOverlay" class="fixed inset-0 z-[60] hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity opacity-0" 
             id="cartBackdrop"
             onclick="toggleCart(false)"></div>

        <div class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col"
             id="cartPanel">
            
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white shadow-sm z-10">
                <h2 class="text-lg font-bold text-gray-900">Shopping Cart</h2>
                <button onclick="toggleCart(false)" class="p-2 hover:bg-gray-100 rounded-full transition-colors group">
                    <svg class="w-6 h-6 text-gray-500 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div id="cartContent" class="flex flex-col h-full overflow-hidden relative">
                @include('partials.cart-sidebar', ['cart' => session()->get('cart', []), 'total' => 0])
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-[80] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity opacity-0" id="deleteBackdrop"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all scale-95 opacity-0 w-full max-w-sm" id="deletePanel">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900">Remove Item?</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" onclick="confirmDelete()" class="inline-flex w-full justify-center rounded-full bg-red-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition-all">Yes, Remove</button>
                        <button type="button" onclick="closeDeleteModal()" class="mt-3 inline-flex w-full justify-center rounded-full bg-white px-5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-all">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- 1. LOGIC GIỎ HÀNG TRƯỢT ---
        function toggleCart(show) {
            const overlay = document.getElementById('cartOverlay');
            const backdrop = document.getElementById('cartBackdrop');
            const panel = document.getElementById('cartPanel');

            if (show) {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('translate-x-full');
                }, 10);
            } else {
                backdrop.classList.add('opacity-0');
                panel.classList.add('translate-x-full');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }

        // --- 2. LOGIC MODAL XÓA (POPUP) ---
        let itemToDeleteKey = null; 

        function openDeleteModal(key) {
            itemToDeleteKey = key;
            const modal = document.getElementById('deleteModal');
            const backdrop = document.getElementById('deleteBackdrop');
            const panel = document.getElementById('deletePanel');

            modal.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function closeDeleteModal() {
            itemToDeleteKey = null;
            const modal = document.getElementById('deleteModal');
            const backdrop = document.getElementById('deleteBackdrop');
            const panel = document.getElementById('deletePanel');

            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function confirmDelete() {
            if (!itemToDeleteKey) return;

            // Gọi AJAX xóa
            fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ key: itemToDeleteKey })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Cập nhật lại HTML giỏ hàng
                    document.getElementById('cartContent').innerHTML = data.cart_html;
                    closeDeleteModal();
                }
            })
            .catch(err => {
                console.error(err);
                alert('Có lỗi xảy ra, vui lòng thử lại');
                closeDeleteModal();
            });
        }
    </script>

    @stack('scripts')
</body>
</html>