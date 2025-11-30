<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winter Jacket Store - Premium Quality</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans text-gray-800 antialiased overflow-x-hidden">

    <header class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md py-4 shadow-sm transition-all duration-300">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-brand-dark"></div>
                <span class="font-bold text-xl tracking-wide text-brand-dark">WINTER STORE</span>
            </div>

            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-500">
                <a href="#" class="text-brand-dark border-b-2 border-brand-dark pb-1">Home</a>
                <a href="#" class="hover:text-brand-dark transition-colors">Product</a>
                <a href="#" class="hover:text-brand-dark transition-colors">Contact</a>
                <a href="#" class="hover:text-brand-dark transition-colors">About</a>
            </nav>

            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-gray-100 text-brand-dark flex items-center justify-center hover:bg-brand-light/30 transition-all">
                   <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
                <button class="bg-brand-dark text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg shadow-brand-dark/30 hover:bg-opacity-90 hover:-translate-y-0.5 transition-all">
                    Sign Up
                </button>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 pt-32 pb-12 min-h-screen flex flex-col justify-center">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5 space-y-8 z-10">
                <div>
                    <h1 class="text-6xl lg:text-7xl font-bold text-brand-dark leading-none tracking-tight">
                        WINTER <br/> 
                        <span class="text-gray-900">JACKET</span>
                    </h1>
                    <h2 class="text-4xl text-brand-DEFAULT font-light mt-2 tracking-widest">COLLECTION</h2>
                </div>
                
                <p class="text-gray-500 leading-relaxed text-lg max-w-md">
                    Khám phá bộ sưu tập áo khoác mùa đông cao cấp, giữ ấm tuyệt đối với phong cách thời thượng nhất năm 2025.
                </p>

                <button class="bg-gray-900 text-white px-10 py-4 rounded-full font-semibold hover:bg-black transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                    Get Started
                </button>

                <div class="flex gap-6 mt-12 pt-8">
                    <div class="group cursor-pointer">
                        <div class="w-40 h-44 bg-[#E8F3E8] rounded-t-xl rounded-b-[4rem] relative flex items-end justify-center pb-6 transition-all hover:bg-[#d4ecd4]">
                            <div class="absolute -top-12 w-28 h-28 bg-gray-200 rounded-full flex items-center justify-center text-xs text-gray-400">
                                IMG
                            </div>
                            <div class="text-center">
                                <h3 class="font-bold text-gray-800 text-sm">Puffer Jkt</h3>
                                <p class="text-brand-dark font-bold text-sm">$105.00</p>
                            </div>
                        </div>
                    </div>

                     <div class="group cursor-pointer">
                        <div class="w-40 h-44 bg-[#E8F3E8] rounded-t-xl rounded-b-[4rem] relative flex items-end justify-center pb-6 transition-all hover:bg-[#d4ecd4]">
                            <div class="absolute -top-12 w-28 h-28 bg-gray-200 rounded-full flex items-center justify-center text-xs text-gray-400">
                                IMG
                            </div>
                            <div class="text-center">
                                <h3 class="font-bold text-gray-800 text-sm">Parka Jkt</h3>
                                <p class="text-brand-dark font-bold text-sm">$89.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 relative flex justify-center items-center">
                <div class="absolute bg-brand-mint w-[500px] h-[500px] lg:w-[650px] lg:h-[650px] rounded-full opacity-100 -z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                
                <div class="relative w-full max-w-md z-10">
                   <img src="https://images.unsplash.com/photo-1544022613-e87ca75a784a?q=80&w=600&auto=format&fit=crop" 
                        alt="Winter Jacket" 
                        class="w-full h-auto drop-shadow-2xl object-cover rounded-2xl grayscale-[20%] hover:grayscale-0 transition-all duration-500 hover:scale-105">
                </div>

                <div class="absolute w-full flex justify-between px-0 lg:px-10 top-1/2">
                    <button class="w-12 h-12 bg-white text-brand-dark rounded-full flex items-center justify-center hover:bg-brand-dark hover:text-white transition-all shadow-lg border border-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="w-12 h-12 bg-brand-dark text-white rounded-full flex items-center justify-center hover:bg-gray-800 transition-all shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

        </div>
    </main>
</body>
</html>