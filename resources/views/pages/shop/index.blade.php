@extends('layouts.app')

@section('title', 'Shop All Products - Winter Store')

@section('content')
    <div class="bg-white pb-20 pt-10">
        <div class="container mx-auto px-6">

            <div class="flex flex-col md:flex-row justify-between items-center mb-10 pb-6 border-b border-gray-100">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">All Products</h1>
                    <p class="text-gray-500 text-sm mt-1">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }}
                        of {{ $products->total() }} results</p>
                </div>

                <div class="flex items-center gap-4 mt-4 md:mt-0">
                    <div class="relative group">
                        <select onchange="window.location.href=this.value"
                            class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-2.5 pl-4 pr-10 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-dark cursor-pointer text-sm font-medium">
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'default']) }}">Sort by: Featured
                            </option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}"
                                {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}"
                                {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}"
                                {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">

                <aside class="hidden lg:block lg:col-span-1 space-y-10">

                    <div>
                        <h3 class="font-bold text-gray-900 mb-5 text-lg">Categories</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{ route('shop.index') }}"
                                    class="flex items-center justify-between text-gray-600 hover:text-brand-dark {{ !request('category') ? 'font-bold text-brand-dark' : '' }}">
                                    <span>All Products</span>
                                </a>
                            </li>
                            @foreach ($categories as $cat)
                                <li>
                                    <a href="{{ route('shop.index', ['category' => $cat->slug]) }}"
                                        class="flex items-center justify-between group cursor-pointer {{ request('category') == $cat->slug ? 'font-bold text-brand-dark' : 'text-gray-600' }}">
                                        <span
                                            class="group-hover:text-brand-dark transition-colors">{{ $cat->name }}</span>
                                        <span
                                            class="text-xs bg-gray-100 text-gray-500 py-0.5 px-2 rounded-full group-hover:bg-brand-dark group-hover:text-white transition-colors">{{ $cat->products_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-bold text-gray-900 mb-5 text-lg">Price Range</h3>
                        <div class="space-y-3 text-sm text-gray-600">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="price"
                                    onclick="window.location.href='{{ request()->fullUrlWithQuery(['min_price' => 0, 'max_price' => 50]) }}'"
                                    class="text-brand-dark focus:ring-brand-dark">
                                <span>Under $50</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="price"
                                    onclick="window.location.href='{{ request()->fullUrlWithQuery(['min_price' => 50, 'max_price' => 150]) }}'"
                                    class="text-brand-dark focus:ring-brand-dark">
                                <span>$50 - $150</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="price"
                                    onclick="window.location.href='{{ request()->fullUrlWithQuery(['min_price' => 150, 'max_price' => 9999]) }}'"
                                    class="text-brand-dark focus:ring-brand-dark">
                                <span>Over $150</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-brand-dark rounded-2xl p-6 text-center text-white relative overflow-hidden">
                        <div class="absolute inset-0 bg-white/10 transform rotate-12 scale-150"></div>
                        <div class="relative z-10">
                            <p class="text-xs font-bold tracking-widest uppercase mb-2 text-brand-light">Season Sale</p>
                            <h4 class="text-2xl font-bold mb-4">Get 50% Off</h4>
                            <button
                                class="bg-white text-brand-dark px-6 py-2 rounded-full text-sm font-bold hover:bg-gray-100 transition-colors">Shop
                                Now</button>
                        </div>
                    </div>
                </aside>

                <div class="lg:col-span-3">
                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($products as $product)
                                <div class="group">
                                    <div class="relative overflow-hidden rounded-2xl bg-gray-100 aspect-[4/5] mb-4">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            @php
                                                // Lấy ảnh chính, nếu không có lấy ảnh đầu tiên
                                                $primaryImg = $product->images->where('is_primary', 1)->first();
                                                $imgUrl = $primaryImg
                                                    ? $primaryImg->image_path
                                                    : $product->images->first()->image_path ??
                                                        'https://via.placeholder.com/400';
                                            @endphp
                                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                                        </a>

                                        @if ($product->is_featured)
                                            <div
                                                class="absolute top-3 left-3 bg-brand-dark text-white text-[10px] font-bold px-2 py-1 rounded-sm uppercase tracking-wider">
                                                Hot</div>
                                        @endif

                                        <div
                                            class="absolute bottom-4 left-0 right-0 px-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                            <a href="{{ route('products.show', $product->slug) }}"
                                                class="block w-full bg-white text-gray-900 text-center py-3 rounded-xl font-bold text-sm shadow-lg hover:bg-brand-dark hover:text-white transition-colors">
                                                View Details
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex justify-between items-start mb-1">
                                            <p class="text-xs text-gray-500">
                                                {{ $product->category->name ?? 'Uncategorized' }}</p>
                                            <div class="flex text-yellow-400 text-xs">★★★★☆</div>
                                        </div>
                                        <h3
                                            class="font-bold text-gray-900 mb-1 group-hover:text-brand-dark transition-colors truncate">
                                            <a
                                                href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h3>
                                        <p class="text-brand-dark font-bold">${{ number_format($product->base_price, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-20 text-center animate-fade-in">
                            <div class="mb-6">
                                <h2 class="text-4xl font-bold text-gray-900 mb-2 tracking-widest uppercase">SORRY !</h2>
                                <p class="text-3xl text-red-600 font-medium">No Product Found.</p>
                            </div>

                            <p class="text-gray-600 text-lg mb-8 max-w-lg mx-auto">
                                @if (request('search'))
                                    No products match your search term <span
                                        class="font-bold text-black">'{{ request('search') }}'</span>.
                                @else
                                    Your filter did not match any products.
                                @endif
                                Please try again.
                            </p>

                            <div class="w-48 h-48 opacity-50 mb-8">
                                <svg class="w-full h-full text-gray-300" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1">
                                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    <path d="M10 10h.01"></path>
                                </svg>
                            </div>

                            <a href="{{ route('shop.index') }}"
                                class="px-10 py-4 bg-brand-dark text-white rounded-full font-bold shadow-lg hover:bg-black hover:-translate-y-1 transition-all">
                                Clear Search & Filters
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
