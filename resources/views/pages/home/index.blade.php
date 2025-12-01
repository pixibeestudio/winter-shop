@extends('layouts.app')

@section('title', 'Home - Winter Store Premium')

@section('content')
    <section class="relative h-screen w-full overflow-hidden bg-gray-900 text-white">
        
        <div id="hero-slider" class="absolute inset-0 w-full h-full">
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 opacity-100 slide-bg" 
                 style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1920&auto=format&fit=crop');">
                <div class="absolute inset-0 bg-black/30"></div>
            </div>
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 opacity-0 slide-bg" 
                 style="background-image: url('https://images.unsplash.com/photo-1544022613-e87ca75a784a?q=80&w=1920&auto=format&fit=crop');">
                <div class="absolute inset-0 bg-black/30"></div>
            </div>
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 opacity-0 slide-bg" 
                 style="background-image: url('https://images.unsplash.com/photo-1515434126000-961d90c046e7?q=80&w=1920&auto=format&fit=crop');">
                <div class="absolute inset-0 bg-black/30"></div>
            </div>
        </div>

        <div class="absolute inset-0 flex items-center justify-center text-center z-10 px-4">
            <div class="space-y-6 max-w-4xl">
                <p id="slide-sub" class="text-sm md:text-base font-bold tracking-[0.2em] uppercase text-white/80 translate-y-10 opacity-0 transition-all duration-1000 delay-300">
                    New Collection 2025
                </p>
                
                <h1 id="slide-title" class="text-5xl md:text-8xl font-serif italic font-bold tracking-tight leading-tight translate-y-10 opacity-0 transition-all duration-1000 delay-500">
                    Outrageous <br> <span class="not-italic text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">Fashion</span>
                </h1>
                
                <div id="slide-btn" class="pt-8 translate-y-10 opacity-0 transition-all duration-1000 delay-700">
                    <a href="{{ route('shop.index') }}" class="inline-block bg-white text-black px-10 py-4 rounded-none font-bold uppercase tracking-widest hover:bg-brand-dark hover:text-white transition-all transform hover:scale-105 shadow-2xl">
                        Shop Collection
                    </a>
                </div>
            </div>
        </div>

        <button onclick="changeSlide(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 border border-white/30 rounded-full flex items-center justify-center hover:bg-white hover:text-black transition-all z-20 hidden md:flex">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button onclick="changeSlide(1)" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 border border-white/30 rounded-full flex items-center justify-center hover:bg-white hover:text-black transition-all z-20 hidden md:flex">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
        </button>

    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-serif italic font-bold text-gray-900">Featured Categories</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="relative h-[500px] group overflow-hidden cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1551488852-080175d27b87?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-colors"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <h4 class="text-2xl font-bold mb-2">Winter Coats</h4>
                        <a href="#" class="text-sm font-bold uppercase tracking-widest border-b-2 border-white pb-1">Shop Now</a>
                    </div>
                </div>
                <div class="relative h-[500px] group overflow-hidden cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1545594861-3bef43ff22c7?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-colors"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <h4 class="text-2xl font-bold mb-2">Trendy Jackets</h4>
                        <a href="#" class="text-sm font-bold uppercase tracking-widest border-b-2 border-white pb-1">Shop Now</a>
                    </div>
                </div>
                <div class="relative h-[500px] group overflow-hidden cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1539533018447-63fcce2678e3?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/30 transition-colors"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <h4 class="text-2xl font-bold mb-2">Men's Collection</h4>
                        <a href="#" class="text-sm font-bold uppercase tracking-widest border-b-2 border-white pb-1">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide-bg');
        const totalSlides = slides.length;
        
        // Các phần tử text cần animate
        const slideSub = document.getElementById('slide-sub');
        const slideTitle = document.getElementById('slide-title');
        const slideBtn = document.getElementById('slide-btn');

        function animateText(show) {
            if (show) {
                // Bay lên và hiện ra
                slideSub.classList.remove('translate-y-10', 'opacity-0');
                slideTitle.classList.remove('translate-y-10', 'opacity-0');
                slideBtn.classList.remove('translate-y-10', 'opacity-0');
            } else {
                // Ẩn đi để chuẩn bị cho lần sau
                slideSub.classList.add('translate-y-10', 'opacity-0');
                slideTitle.classList.add('translate-y-10', 'opacity-0');
                slideBtn.classList.add('translate-y-10', 'opacity-0');
            }
        }

        function showSlide(index) {
            // 1. Ẩn text trước
            animateText(false);

            setTimeout(() => {
                // 2. Đổi ảnh sau khi text đã ẩn
                slides.forEach((slide, i) => {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                    if (i === index) {
                        slide.classList.remove('opacity-0');
                        slide.classList.add('opacity-100');
                    }
                });

                // 3. Hiện text lại sau khi ảnh đã đổi
                setTimeout(() => {
                    animateText(true);
                }, 500); // Chờ ảnh hiện 1 chút rồi mới hiện text
            }, 500);
        }

        function changeSlide(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        // Tự động chạy mỗi 5 giây
        setInterval(() => {
            changeSlide(1);
        }, 5000);

        // Chạy lần đầu
        setTimeout(() => {
            animateText(true);
        }, 100);
    </script>
@endsection