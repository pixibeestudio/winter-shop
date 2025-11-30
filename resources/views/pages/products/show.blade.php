@extends('layouts.app')

@section('title', $product->name . ' - Winter Store')

@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-6 mb-8">
        <nav class="flex text-sm text-gray-500 gap-2">
            <a href="/" class="hover:text-black transition-colors">Home</a> / 
            <a href="{{ route('shop.index') }}" class="hover:text-black transition-colors">Shop</a> / 
            <span class="text-black font-medium">{{ $product->name }}</span>
        </nav>
    </div>

    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
            
            <div class="lg:w-1/2 space-y-4">
                <div class="relative bg-gray-100 rounded-lg overflow-hidden group cursor-zoom-in aspect-[4/5]">
                    @php 
                        $mainImg = $product->images->where('is_primary', 1)->first() ?? $product->images->first();
                        $mainImgUrl = $mainImg ? $mainImg->image_path : 'https://via.placeholder.com/500';
                    @endphp
                    <img id="mainImage" src="{{ $mainImgUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    
                    @if($product->created_at->diffInDays(now()) < 7)
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 uppercase tracking-wider">New</span>
                    @endif
                </div>

                <div class="flex gap-4 overflow-x-auto pb-2">
                    @foreach($product->images as $img)
                        <button onclick="changeImage('{{ $img->image_path }}')" class="w-20 h-24 shrink-0 border border-transparent hover:border-black transition-all rounded-md overflow-hidden">
                            <img src="{{ $img->image_path }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="lg:w-1/2">
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 font-serif">{{ $product->name }}</h1>
                
                <div class="flex items-center gap-6 mb-6">
                    <span class="text-2xl font-bold text-gray-900" id="displayPrice">${{ number_format($product->base_price, 2) }}</span>
                    
                    <div class="flex items-center gap-2 border-l border-gray-300 pl-6">
                        <div class="flex text-yellow-500 text-sm">
                            @for($i=1; $i<=5; $i++)
                                <span>{{ $i <= round($avgRating) ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                        <a href="#reviews" class="text-sm text-gray-500 hover:text-black underline">({{ $product->reviews_count }} customer reviews)</a>
                    </div>
                </div>

                <div class="prose text-gray-600 mb-8 text-sm leading-relaxed">
                    {{ Str::limit($product->description, 150) }}
                </div>

                <div class="space-y-6 pb-8 border-b border-gray-100">
                    
                    <div>
                        <span class="block text-sm font-bold text-gray-900 mb-3">Color: <span id="selectedColorName" class="font-normal text-gray-500 ml-1">Select a color</span></span>
                        <div class="flex flex-wrap gap-3">
                            @foreach($colors as $color)
                                <button onclick="selectColor('{{ $color }}')" 
                                        class="color-btn px-4 py-2 border border-gray-200 rounded-md text-sm hover:border-black hover:bg-gray-50 transition-all focus:ring-2 focus:ring-black focus:ring-offset-1"
                                        data-color="{{ $color }}">
                                    {{ $color }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-3">
                            <span class="block text-sm font-bold text-gray-900">Size: <span id="selectedSizeName" class="font-normal text-gray-500 ml-1"></span></span>
                            <a href="#" class="text-xs text-gray-500 underline uppercase tracking-wide">Size Chart</a>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            @foreach($sizes as $size)
                                <button onclick="selectSize('{{ $size }}')" 
                                        class="size-btn w-12 h-10 border border-gray-200 rounded-md text-sm font-medium hover:border-black transition-all flex items-center justify-center disabled:opacity-20 disabled:cursor-not-allowed disabled:bg-gray-100"
                                        data-size="{{ $size }}">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="py-8 flex gap-4 items-center">
                    <div class="flex items-center border border-gray-300 rounded-md h-12 w-32">
                        <button class="w-10 h-full text-gray-600 hover:bg-gray-100 transition-colors text-xl font-light" onclick="updateQty(-1)">-</button>
                        <input type="text" id="qtyInput" value="1" class="w-full h-full text-center border-none focus:ring-0 font-bold text-gray-900" readonly>
                        <button class="w-10 h-full text-gray-600 hover:bg-gray-100 transition-colors text-xl font-light" onclick="updateQty(1)">+</button>
                    </div>

                    <button id="addToCartBtn" onclick="addToCart()" disabled 
                            class="flex-1 bg-black text-white h-12 rounded-md font-bold uppercase tracking-widest text-sm hover:bg-gray-800 transition-all disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed shadow-lg">
                        Select Options
                    </button>
                    
                    <button class="w-12 h-12 border border-gray-300 rounded-md flex items-center justify-center hover:border-red-500 hover:text-red-500 transition-colors text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </div>
                
                <div class="space-y-2 text-xs text-gray-500 uppercase tracking-wider">
                    <p>SKU: <span id="skuDisplay" class="text-gray-900">N/A</span></p>
                    <p>Category: <span class="text-gray-900">{{ $product->category->name }}</span></p>
                </div>
                
                <div class="grid grid-cols-3 gap-4 mt-8 pt-8 border-t border-gray-100">
                    <div class="text-center">
                        <svg class="w-6 h-6 mx-auto mb-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        <span class="text-xs font-bold text-gray-900">Free Shipping<br>Orders $99+</span>
                    </div>
                    <div class="text-center">
                        <svg class="w-6 h-6 mx-auto mb-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-xs font-bold text-gray-900">Delivery 2-3<br>Working Days</span>
                    </div>
                    <div class="text-center">
                        <svg class="w-6 h-6 mx-auto mb-2 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        <span class="text-xs font-bold text-gray-900">Free Returns<br>& Exchange</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-20 border-t border-gray-200 pt-12" id="reviews">
            <div class="flex justify-center gap-8 mb-12 border-b border-gray-200 pb-1">
                <button class="pb-4 text-sm font-bold uppercase tracking-wider text-gray-400 hover:text-black transition-colors" onclick="switchTab('desc', this)">Description</button>
                <button class="pb-4 text-sm font-bold uppercase tracking-wider border-b-2 border-black text-black" onclick="switchTab('reviews', this)">Reviews ({{ $product->reviews_count }})</button>
            </div>

            <div id="tab-desc" class="hidden max-w-3xl mx-auto text-gray-600 leading-relaxed text-center">
                <p>{{ $product->description }}</p>
                <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div id="tab-reviews" class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    
                    <div class="space-y-8">
                        <h3 class="font-bold text-lg mb-6">{{ $product->reviews_count }} review(s) for {{ $product->name }}</h3>
                        
                        @forelse($product->reviews as $review)
                            <div class="flex gap-4 border-b border-gray-100 pb-6 last:border-0">
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-500 shrink-0">
                                    {{ substr($review->user->name ?? 'User', 0, 1) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="flex text-yellow-500 text-xs">
                                            @for($i=1; $i<=5; $i++) <span>{{ $i <= $review->rating ? '★' : '☆' }}</span> @endfor
                                        </div>
                                    </div>
                                    <p class="font-bold text-sm text-gray-900">{{ $review->user->name ?? 'Guest' }} <span class="text-gray-400 font-normal ml-2 text-xs">| {{ $review->created_at->format('M d, Y') }}</span></p>
                                    <p class="text-gray-600 text-sm mt-2">{{ $review->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">There are no reviews yet.</p>
                        @endforelse
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl border border-gray-100 h-fit">
                        <h3 class="font-bold text-lg mb-2">Add a review</h3>
                        <p class="text-xs text-gray-500 mb-6">Your email address will not be published. Required fields are marked *</p>

                        @auth
                            <form action="{{ route('products.review', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Your rating *</label>
                                    <div class="flex flex-row-reverse justify-end gap-1 text-2xl text-gray-300 hover:text-yellow-400 cursor-pointer w-fit">
                                        <input type="radio" name="rating" value="5" id="s5" class="peer hidden"><label for="s5" class="peer-checked:text-yellow-400 hover:text-yellow-400 transition-colors">★</label>
                                        <input type="radio" name="rating" value="4" id="s4" class="peer hidden"><label for="s4" class="peer-checked:text-yellow-400 hover:text-yellow-400 transition-colors">★</label>
                                        <input type="radio" name="rating" value="3" id="s3" class="peer hidden"><label for="s3" class="peer-checked:text-yellow-400 hover:text-yellow-400 transition-colors">★</label>
                                        <input type="radio" name="rating" value="2" id="s2" class="peer hidden"><label for="s2" class="peer-checked:text-yellow-400 hover:text-yellow-400 transition-colors">★</label>
                                        <input type="radio" name="rating" value="1" id="s1" class="peer hidden"><label for="s1" class="peer-checked:text-yellow-400 hover:text-yellow-400 transition-colors">★</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Your review *</label>
                                    <textarea name="comment" rows="4" class="w-full border border-gray-300 rounded-md p-3 text-sm focus:ring-black focus:border-black" required placeholder="Write your thoughts here..."></textarea>
                                </div>

                                <button type="submit" class="w-full bg-black text-white py-3 rounded-md font-bold text-sm hover:bg-gray-800 transition-all uppercase tracking-widest">Submit Review</button>
                            </form>
                        @else
                            <div class="text-center py-6">
                                <p class="text-gray-600 mb-4">You must be logged in to post a review.</p>
                                <a href="#" class="inline-block bg-black text-white px-6 py-2 rounded-md text-sm font-bold">Login Now</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-xl animate-bounce-slow z-50">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="fixed bottom-4 right-4 bg-red-600 text-white px-6 py-3 rounded-lg shadow-xl animate-bounce-slow z-50">
                {{ session('error') }}
            </div>
        @endif

    </div>
</div>

@push('scripts')
<script>
    // 1. Dữ liệu Variants từ Laravel -> JS
    const variants = @json($product->variants);
    let selected = { color: null, size: null };

    // 2. JS đổi Tab
    function switchTab(tabName, btn) {
        document.getElementById('tab-desc').classList.add('hidden');
        document.getElementById('tab-reviews').classList.add('hidden');
        document.getElementById('tab-' + tabName).classList.remove('hidden');

        // Reset style nút
        btn.parentElement.querySelectorAll('button').forEach(b => {
            b.classList.remove('border-b-2', 'border-black', 'text-black');
            b.classList.add('text-gray-400');
        });
        btn.classList.remove('text-gray-400');
        btn.classList.add('border-b-2', 'border-black', 'text-black');
    }

    // 3. Logic chọn biến thể (Giữ nguyên logic cũ nhưng cập nhật UI mới)
    function selectColor(color) {
        selected.color = color;
        selected.size = null; 
        
        // Update UI Text
        document.getElementById('selectedColorName').innerText = color;
        document.getElementById('selectedSizeName').innerText = '';

        // Style Buttons
        document.querySelectorAll('.color-btn').forEach(btn => {
            if(btn.dataset.color === color) {
                btn.classList.add('border-black', 'bg-gray-50', 'ring-1', 'ring-black');
            } else {
                btn.classList.remove('border-black', 'bg-gray-50', 'ring-1', 'ring-black');
            }
        });

        // Filter Sizes
        const availableSizes = variants.filter(v => v.color === color && v.stock_quantity > 0).map(v => v.size);
        document.querySelectorAll('.size-btn').forEach(btn => {
            const size = btn.dataset.size;
            btn.classList.remove('bg-black', 'text-white', 'border-black');
            
            if(availableSizes.includes(size)) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        });

        checkSelection();
    }

    function selectSize(size) {
        if(!selected.color) return;
        selected.size = size;
        document.getElementById('selectedSizeName').innerText = size;

        document.querySelectorAll('.size-btn').forEach(btn => {
            if(btn.dataset.size === size) {
                btn.classList.add('bg-black', 'text-white', 'border-black');
            } else {
                btn.classList.remove('bg-black', 'text-white', 'border-black');
            }
        });
        checkSelection();
    }

    function checkSelection() {
        const btn = document.getElementById('addToCartBtn');
        const variant = variants.find(v => v.color === selected.color && v.size === selected.size);

        if(variant) {
            btn.disabled = false;
            btn.innerText = "ADD TO CART";
            document.getElementById('skuDisplay').innerText = variant.sku;
            // Update Price (Nếu có logic giá theo size)
            if(parseFloat(variant.price_adjustment) > 0) {
                 // Logic cộng giá... (optional)
            }
        } else {
            btn.disabled = true;
            btn.innerText = selected.color ? "SELECT SIZE" : "SELECT OPTIONS";
        }
    }

    function changeImage(src) {
        document.getElementById('mainImage').src = src;
    }
    
    function updateQty(change) {
        let input = document.getElementById('qtyInput');
        let newVal = parseInt(input.value) + change;
        if(newVal >= 1) input.value = newVal;
    }

    // Hàm addToCart AJAX (Dùng lại hàm cũ của bạn, chỉ sửa id input)
    function addToCart() {
        if(!selected.color || !selected.size) return;

        const btn = document.getElementById('addToCartBtn');
        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = "ADDING...";

        fetch('{{ route('cart.add') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: {{ $product->id }},
                quantity: parseInt(document.getElementById('qtyInput').value),
                color: selected.color,
                size: selected.size
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                btn.innerText = "ADDED!";
                btn.classList.replace('bg-black', 'bg-green-600');
                document.getElementById('cartContent').innerHTML = data.cart_html;
                setTimeout(() => {
                    toggleCart(true); // Mở giỏ hàng
                    btn.disabled = false;
                    btn.innerText = "ADD TO CART";
                    btn.classList.replace('bg-green-600', 'bg-black');
                }, 800);
            }
        });
    }
</script>
@endpush
@endsection