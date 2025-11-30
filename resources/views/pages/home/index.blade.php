@extends('layouts.app')

@section('title', 'Home - Winter Store Premium')

@section('content')
    {{-- Sử dụng overflow-visible để các phần tử con (như thẻ sản phẩm nhỏ) có thể "nhô" ra ngoài mà không bị cắt --}}
    <section class="relative min-h-[90vh] flex items-center bg-white overflow-visible pt-10 lg:pt-0">
        
        <div class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center h-full">
            
            <div class="lg:col-span-5 space-y-8 z-20 relative">
                <div class="animate-fade-in-up space-y-6">
                    <span class="text-brand-DEFAULT font-bold tracking-widest uppercase text-sm">New Collection 2025</span>
                    <h1 class="text-5xl lg:text-7xl font-bold text-brand-dark leading-[1.1]">
                        WINTER <br/> 
                        <span class="text-gray-800">JACKET</span>
                    </h1>
                    <h2 class="text-3xl lg:text-4xl text-brand-DEFAULT font-light mt-2">STORE</h2>
                    
                    <p class="text-gray-500 text-lg leading-relaxed max-w-md">
                        Khám phá sự kết hợp hoàn hảo giữa phong cách thời thượng và khả năng giữ ấm tuyệt đối cho mùa đông này.
                    </p>
    
                    <div class="pt-4">
                        <button class="bg-brand-dark text-white px-10 py-4 rounded-full font-semibold hover:bg-black transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                            Get Started
                        </button>
                    </div>
                </div>

                <div class="flex gap-6 mt-12 pt-10 lg:absolute lg:bottom-[-180px] lg:left-0">
                    <div class="group cursor-pointer relative">
                        <div class="w-40 h-40 bg-brand-mint/50 rounded-t-2xl rounded-b-[3rem] flex items-end justify-center pb-4 shadow-sm group-hover:shadow-md transition-all">
                            <img src="https://pngimg.com/d/jacket_PNG8051.png" alt="Small Jacket 1" class="absolute -top-14 w-28 drop-shadow-xl transform group-hover:scale-105 transition-all duration-300">
                            <div class="text-center relative z-10 mt-10">
                                <h3 class="font-bold text-brand-dark text-sm">Lorem Jacket</h3>
                                <p class="text-xs text-gray-500 mb-1">Waterproof</p>
                                <p class="text-brand-dark font-bold text-sm">$105.00</p>
                            </div>
                        </div>
                    </div>

                     <div class="group cursor-pointer relative mt-8 lg:mt-0">
                        <div class="w-40 h-40 bg-brand-mint/50 rounded-t-2xl rounded-b-[3rem] flex items-end justify-center pb-4 shadow-sm group-hover:shadow-md transition-all">
                            <img src="https://pngimg.com/d/jacket_PNG8058.png" alt="Small Jacket 2" class="absolute -top-14 w-28 drop-shadow-xl transform group-hover:scale-105 transition-all duration-300">
                             <div class="text-center relative z-10 mt-10">
                                <h3 class="font-bold text-brand-dark text-sm">Ipsum Jacket</h3>
                                <p class="text-xs text-gray-500 mb-1">Premium</p>
                                <p class="text-brand-dark font-bold text-sm">$89.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 relative flex justify-center items-center min-h-[500px] lg:min-h-[700px]">
                
                <div class="absolute bg-brand-mint w-[90%] h-[80%] lg:w-[110%] lg:h-[110%] rounded-full opacity-100 z-0 translate-y-10 lg:translate-x-10 lg:translate-y-0"></div>
                
                <div class="relative w-full max-w-lg z-10">
                   {{-- Ảnh mẫu placeholder PNG trong suốt --}}
                   <img src="https://pngimg.com/d/jacket_PNG8038.png" 
                        alt="Main Winter Jacket" 
                        class="w-full h-auto drop-shadow-2xl object-contain hover:scale-105 transition-all duration-500">
                </div>

                {{-- Đặt absolute để nó nổi lên trên, căn giữa theo chiều dọc (top-1/2) --}}
                <div class="absolute w-full flex justify-between items-center px-2 lg:px-0 z-20 top-1/2 -translate-y-1/2 lg:-left-[10%] lg:w-[120%]">
                    <button class="w-12 h-12 md:w-14 md:h-14 bg-brand-dark text-white rounded-full flex items-center justify-center hover:bg-brand hover:scale-110 transition-all shadow-lg shadow-brand-dark/30 group">
                        <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="w-12 h-12 md:w-14 md:h-14 bg-brand-dark text-white rounded-full flex items-center justify-center hover:bg-brand hover:scale-110 transition-all shadow-lg shadow-brand-dark/30 group">
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <div class="h-40 lg:h-60"></div>
@endsection