@extends('layouts.app')

@section('title', $product->name . ' - Winter Store')

@section('content')
<div class="bg-white pb-20">
    <div class="container mx-auto px-6 py-4">
        <nav class="flex text-sm text-gray-500 gap-2">
            <a href="/" class="hover:text-brand-dark">Home</a>
            <span>/</span>
            <a href="#" class="hover:text-brand-dark">{{ $product->category }}</a>
            <span>/</span>
            <span class="text-brand-dark font-medium truncate">{{ $product->name }}</span>
        </nav>
    </div>

    <div class="container mx-auto px-6 mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            
            <div class="space-y-4">
                <div class="relative bg-gray-50 rounded-2xl overflow-hidden aspect-[4/5] group cursor-zoom-in">
                    <img id="mainImage" 
                         src="{{ $images[0] }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-contain object-center transition-transform duration-500 group-hover:scale-110">
                    
                    <span class="absolute top-4 left-4 bg-brand-dark text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        New Arrival
                    </span>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    @foreach($images as $index => $img)
                        <button onclick="changeImage('{{ $img }}')" 
                                class="aspect-square rounded-xl bg-gray-50 border-2 {{ $index == 0 ? 'border-brand-dark' : 'border-transparent' }} hover:border-brand-dark transition-all overflow-hidden">
                            <img src="{{ $img }}" class="w-full h-full object-contain p-2">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="lg:sticky lg:top-24 h-fit">
                <div class="mb-6">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                    <div class="flex items-center gap-4">
                        <div class="flex text-yellow-400 text-sm">
                            ★★★★★ <span class="text-gray-400 ml-2">({{ $product->reviews_count }} Reviews)</span>
                        </div>
                        <span class="text-gray-300">|</span>
                        <span class="text-green-600 font-medium text-sm">In Stock</span>
                    </div>
                </div>

                <div class="mb-8">
                    <span id="productPrice" class="text-3xl font-bold text-brand-dark">${{ number_format($product->price, 2) }}</span>
                </div>

                <p class="text-gray-500 leading-relaxed mb-8">
                    {{ $product->description }}
                </p>

                <div class="space-y-6 border-t border-b border-gray-100 py-6">
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-900 mb-3">Color: <span id="selectedColorName" class="font-normal text-gray-500">Select a color</span></label>
                        <div class="flex gap-3">
                            @foreach($colors as $color)
                                @php
                                    // Tìm mã hex của màu này trong mảng variants
                                    $variantKey = array_search($color, array_column($variants, 'color'));
                                    $hex = $variants[$variantKey]['color_code'];
                                @endphp
                                <button onclick="selectColor('{{ $color }}')" 
                                        class="w-10 h-10 rounded-full border-2 border-transparent ring-2 ring-transparent focus:ring-brand-dark hover:scale-110 transition-all color-btn"
                                        data-color="{{ $color }}"
                                        style="background-color: {{ $hex }};"></button>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-3">
                            <label class="block text-sm font-bold text-gray-900">Size: <span id="selectedSizeName" class="font-normal text-gray-500"></span></label>
                            <a href="#" class="text-xs text-brand-dark underline">Size Guide</a>
                        </div>
                        <div class="grid grid-cols-4 gap-3" id="sizeContainer">
                            @foreach($sizes as $size)
                                <button onclick="selectSize('{{ $size }}')" 
                                        class="border border-gray-200 rounded-lg py-3 text-sm font-medium hover:border-brand-dark transition-all size-btn"
                                        data-size="{{ $size }}">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <div class="flex items-center border border-gray-300 rounded-full w-32 px-4">
                        <button class="text-gray-500 hover:text-brand-dark px-2">-</button>
                        <input type="text" value="1" class="w-full text-center border-none focus:ring-0 font-bold text-gray-900">
                        <button class="text-gray-500 hover:text-brand-dark px-2">+</button>
                    </div>

                    <button id="addToCartBtn" onclick="addToCart()" class="flex-1 bg-brand-dark text-white rounded-full font-bold text-lg hover:bg-black transition-all shadow-xl hover:shadow-2xl disabled:opacity-50 disabled:cursor-not-allowed">
                        Add to Cart - $<span id="btnPrice">{{ number_format($product->price, 2) }}</span>
                    </button>

                    <button class="w-14 h-14 rounded-full border border-gray-200 flex items-center justify-center hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>

                <div class="mt-8 space-y-4 text-sm text-gray-500 bg-gray-50 p-4 rounded-xl">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        <span>Free shipping on orders over $200</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        <span>30 days return policy</span>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="mt-20 border-t border-gray-200 pt-10">
             <h3 class="font-bold text-xl mb-4">Product Details</h3>
             <div class="prose max-w-none text-gray-600">
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
             </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // 1. Dữ liệu từ Server đổ vào JS để xử lý Logic
    const variants = @json($variants);
    
    let currentSelection = {
        color: null,
        size: null
    };

    // 2. Hàm đổi ảnh khi click thumbnail
    function changeImage(src) {
        document.getElementById('mainImage').src = src;
        // Thêm hiệu ứng active cho thumbnail (bạn có thể tự code thêm class border)
    }

    // 3. Hàm chọn Màu
    function selectColor(color) {
        currentSelection.color = color;
        currentSelection.size = null; // Reset size khi đổi màu
        
        // Update UI Text
        document.getElementById('selectedColorName').innerText = color;
        document.getElementById('selectedSizeName').innerText = '';

        // Highlight nút màu được chọn
        document.querySelectorAll('.color-btn').forEach(btn => {
            if(btn.dataset.color === color) {
                btn.classList.add('ring-2', 'ring-brand-dark', 'ring-offset-2');
            } else {
                btn.classList.remove('ring-2', 'ring-brand-dark', 'ring-offset-2');
            }
        });

        // LỌC SIZE: Chỉ hiện những size có sẵn của màu này
        const availableSizes = variants.filter(v => v.color === color).map(v => v.size);
        
        document.querySelectorAll('.size-btn').forEach(btn => {
            const size = btn.dataset.size;
            
            // Reset style
            btn.classList.remove('bg-brand-dark', 'text-white', 'border-brand-dark');
            btn.classList.add('border-gray-200');
            
            // Check disable logic
            if(availableSizes.includes(size)) {
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-gray-100');
            } else {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed', 'bg-gray-100');
            }
        });

        updateAddToCartBtn();
    }

    // 4. Hàm chọn Size
    function selectSize(size) {
        if(!currentSelection.color) {
            alert('Please select a color first');
            return;
        }
        currentSelection.size = size;
        
        // Update UI Text
        document.getElementById('selectedSizeName').innerText = size;

        // Highlight nút size
        document.querySelectorAll('.size-btn').forEach(btn => {
            if(btn.dataset.size === size) {
                btn.classList.add('bg-brand-dark', 'text-white', 'border-brand-dark');
                btn.classList.remove('border-gray-200');
            } else {
                btn.classList.remove('bg-brand-dark', 'text-white', 'border-brand-dark');
                btn.classList.add('border-gray-200');
            }
        });

        updatePrice();
        updateAddToCartBtn();
    }

    // 5. Cập nhật giá và nút mua hàng
    function updatePrice() {
        // Tìm biến thể khớp với màu và size đã chọn
        const variant = variants.find(v => v.color === currentSelection.color && v.size === currentSelection.size);
        
        if(variant) {
            const priceFormatted = new Intl.NumberFormat('en-US', { style: 'decimal', minimumFractionDigits: 2 }).format(variant.price);
            document.getElementById('productPrice').innerText = '$' + priceFormatted;
            document.getElementById('btnPrice').innerText = priceFormatted;
        }
    }

    function updateAddToCartBtn() {
        const btn = document.getElementById('addToCartBtn');
        if(currentSelection.color && currentSelection.size) {
            // Kiểm tra tồn kho (Logic nâng cao)
            const variant = variants.find(v => v.color === currentSelection.color && v.size === currentSelection.size);
            if(variant && variant.stock > 0) {
                btn.disabled = false;
                btn.innerHTML = `Add to Cart - $${document.getElementById('btnPrice').innerText}`;
            } else {
                btn.disabled = true;
                btn.innerText = 'Out of Stock';
            }
        } else {
            btn.disabled = true; // Chưa chọn đủ thì không cho mua
        }
    }

    function addToCart() {
        // 1. Validate lần cuối
        if(!currentSelection.color || !currentSelection.size) return;

        // 2. Hiệu ứng Loading cho nút (UX Premium)
        const btn = document.getElementById('addToCartBtn');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Adding...`;

        // 3. Giả lập gọi API (AJAX) - Mất 1 giây
        setTimeout(() => {
            // Restore nút bấm
            btn.innerHTML = "Added Successfully!";
            btn.classList.replace('bg-brand-dark', 'bg-green-600'); // Đổi màu xanh báo thành công
            
            setTimeout(() => {
                btn.disabled = false;
                btn.innerHTML = originalText;
                btn.classList.replace('bg-green-600', 'bg-brand-dark'); // Trả về màu cũ
                
                // 4. Mở Giỏ hàng slide-over ra
                toggleCart(true); 
            }, 800);
            
        }, 1000);

        // *Lưu ý: Ở bước sau, chúng ta sẽ thay đoạn setTimeout này bằng lệnh fetch('/cart/add') thật sự.
    }
</script>
@endpush
@endsection