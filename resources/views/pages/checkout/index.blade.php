@extends('layouts.app')

@section('title', 'Our Shop - Winter Store Premium')

@section('content')
<section class="relative h-[300px] flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1920&auto=format&fit=crop');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 text-center text-white space-y-3 animate-fade-in-up">
        <h1 class="text-4xl md:text-5xl font-bold tracking-tight">Our Shop</h1>
        <nav class="flex justify-center items-center text-sm font-medium space-x-2 text-white/80">
            <a href="/" class="hover:text-white transition-colors">Home</a>
            <span>/</span>
            <span class="text-white">Shop</span>
        </nav>
    </div>
</section>

<div class="bg-white pb-20 pt-16">
    <div class="container mx-auto px-6">
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            <aside class="hidden lg:block lg:col-span-1 space-y-12 pr-4">
                
                <div>
                    <h3 class="font-bold text-gray-900 mb-6 text-lg uppercase tracking-wider">Product Categories</h3>
                    <ul class="space-y-4 text-sm text-gray-600">
                        <li>
                            <a href="{{ route('shop.index') }}" class="flex items-center justify-between group hover:text-brand-dark transition-colors {{ !request('category') ? 'text-brand-dark font-bold' : '' }}">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 border border-gray-300 rounded mr-3 flex items-center justify-center group-hover:border-brand-dark {{ !request('category') ? 'bg-brand-dark border-brand-dark' : '' }}">
                                        @if(!request('category')) <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> @endif
                                    </span>
                                    All Products
                                </div>
                                <span class="text-gray-400">({{ \App\Models\Product::count() }})</span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between group hover:text-brand-dark transition-colors {{ request('category') == $cat->slug ? 'text-brand-dark font-bold' : '' }}">
                                    <div class="flex items-center">
                                        <span class="w-4 h-4 border border-gray-300 rounded mr-3 flex items-center justify-center group-hover:border-brand-dark {{ request('category') == $cat->slug ? 'bg-brand-dark border-brand-dark' : '' }}">
                                            @if(request('category') == $cat->slug) <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg> @endif
                                        </span>
                                        {{ $cat->name }}
                                    </div>
                                    <span class="text-gray-400">({{ $cat->products_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                 <div>
                    <h3 class="font-bold text-gray-900 mb-6 text-lg uppercase tracking-wider">Color</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-black border-2 border-white ring-2 ring-gray-200 hover:ring-brand-dark transition-all" title="Black"></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-[#40513B] border-2 border-white ring-2 ring-gray-200 hover:ring-brand-dark transition-all" title="Olive Green"></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-800 border-2 border-white ring-2 ring-gray-200 hover:ring-brand-dark transition-all" title="Navy"></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-[#D4D4D8] border-2 border-white ring-2 ring-gray-200 hover:ring-brand-dark transition-all" title="Beige"></a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-gray-900 mb-6 text-lg uppercase tracking-wider">Price</h3>
                    <ul class="space-y-4 text-sm text-gray-600">
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['min_price' => 0, 'max_price' => 50]) }}" class="flex items-center group hover:text-brand-dark transition-colors">
                                <span class="w-4 h-4 border border-gray-300 rounded-full mr-3 flex items-center justify-center group-hover:border-brand-dark {{ request('max_price') == 50 ? 'bg-brand-dark border-brand-dark' : '' }}">
                                     @if(request('max_price') == 50) <div class="w-2 h-2 bg-white rounded-full"></div> @endif
                                </span>
                                Under $50
                            </a>
                        </li>
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['min_price' => 50, 'max_price' => 150]) }}" class="flex items-center group hover:text-brand-dark transition-colors">
                                <span class="w-4 h-4 border border-gray-300 rounded-full mr-3 flex items-center justify-center group-hover:border-brand-dark {{ request('max_price') == 150 ? 'bg-brand-dark border-brand-dark' : '' }}">
                                     @if(request('max_price') == 150) <div class="w-2 h-2 bg-white rounded-full"></div> @endif
                                </span>
                                $50 - $150
                            </a>
                        </li>
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['min_price' => 150, 'max_price' => 9999]) }}" class="flex items-center group hover:text-brand-dark transition-colors">
                                <span class="w-4 h-4 border border-gray-300 rounded-full mr-3 flex items-center justify-center group-hover:border-brand-dark {{ request('min_price') == 150 ? 'bg-brand-dark border-brand-dark' : '' }}">
                                    @if(request('min_price') == 150) <div class="w-2 h-2 bg-white rounded-full"></div> @endif
                                </span>
                                Over $150
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-gray-900 mb-6 text-lg uppercase tracking-wider">Recent Products</h3>
                    <div class="space-y-5">
                        @foreach($products->take(3) as $product)
                        <div class="flex gap-4 items-start group">
                            <div class="w-20 h-24 bg-gray-100 rounded-md overflow-hidden shrink-0 relative">
                                 <img src="{{ $product->images->first()->image_path ?? 'https://via.placeholder.com/80' }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 line-clamp-2 group-hover:text-brand-dark transition-colors">
                                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h4>
                                <div class="flex text-yellow-400 text-xs my-1">★★★★★</div>
                                <p class="text-brand-dark font-bold text-sm">${{ number_format($product->base_price, 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </aside>

            <div class="lg:col-span-3">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4">
                    <p class="text-gray-500 text-sm">
                        Showing <span class="font-medium text-gray-900">{{ $products->firstItem() }}–{{ $products->lastItem() }}</span> of <span class="font-medium text-gray-900">{{ $products->total() }}</span> results
                    </p>
                    
                    <div class="flex items-center gap-4 mt-4 md:mt-0">
                        <div class="relative group">
                            <select onchange="window.location.href=this.value" class="appearance-none bg-white border-b border-gray-200 text-gray-700 py-2 pr-10 pl-2 focus:outline-none focus:border-brand-dark cursor-pointer text-sm font-medium transition-colors hover:border-gray-400">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'default']) }}">Sort by: Default</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Date, new to old</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                        @foreach($products as $product)
                            @php
                                $primaryImg = $product->images->where('is_primary', 1)->first();
                                $imgUrl = $primaryImg ? $primaryImg->image_path : ($product->images->first()->image_path ?? 'https://via.placeholder.com/400');
                                // Giả lập logic SALE và NEW (để hiện badge cho đẹp giống mẫu)
                                $isSale = $product->base_price < 150;
                                $isNew = $product->created_at->diffInDays(now()) < 7;
                                $salePrice = $isSale ? $product->base_price * 0.8 : null; // Giảm 20% nếu sale
                            @endphp
                            
                            <div class="group relative">
                                <div class="relative overflow-hidden rounded-lg bg-gray-100 aspect-[3/4] mb-6">
                                    <a href="{{ route('products.show', $product->slug) }}" class="block h-full">
                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105">
                                    </a>
                                    
                                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                                        @if($isNew)
                                            <span class="bg-green-500 text-white text-[10px] font-bold px-3 py-1 uppercase tracking-wider leading-none">New In</span>
                                        @endif
                                        @if($isSale)
                                            <span class="bg-red-500 text-white text-[10px] font-bold px-3 py-1 uppercase tracking-wider leading-none">-20% Off</span>
                                        @endif
                                    </div>

                                    <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-gradient-to-t from-black/50 to-transparent">
                                        <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-white text-brand-dark text-center py-3 rounded-full font-bold text-sm hover:bg-brand-dark hover:text-white transition-colors">
                                            Quick View
                                        </a>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <p class="text-xs text-gray-500 mb-2 uppercase tracking-widest">{{ $product->category->name ?? 'Category' }}</p>
                                    <h3 class="font-bold text-base text-gray-900 mb-2 group-hover:text-brand-dark transition-colors line-clamp-1">
                                        <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="flex justify-center items-center gap-3 font-bold">
                                        @if($isSale)
                                            <span class="text-gray-400 line-through">${{ number_format($product->base_price, 2) }}</span>
                                            <span class="text-red-500">${{ number_format($salePrice, 2) }}</span>
                                        @else
                                            <span class="text-gray-900">${{ number_format($product->base_price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-16 flex justify-center">
                        {{ $products->onEachSide(1)->links() }}
                    </div>

                @else
                    <div class="text-center py-32 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <h3 class="text-xl font-bold text-gray-900">No products found</h3>
                        <p class="text-gray-500 mt-2">Try changing your filters or search for something else.</p>
                        <a href="{{ route('shop.index') }}" class="inline-block mt-6 px-8 py-3 bg-brand-dark text-white rounded-full font-bold hover:shadow-lg transition-all">Clear Filters</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection