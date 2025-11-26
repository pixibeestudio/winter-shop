<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winter Jacket Store - Premium Quality</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Hiệu ứng mượt mà */
        .smooth-transition { transition: all 0.3s ease-in-out; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-['Inter'] text-gray-800 antialiased">

    <header class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-md py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-brand-dark"></div> <span class="font-bold text-lg tracking-wide text-brand-dark">Company Name</span>
            </div>

            <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-500">
                <a href="#" class="text-brand-dark border-b-2 border-brand-dark pb-1">Home</a>
                <a href="#" class="hover:text-brand-dark smooth-transition">Product</a>
                <a href="#" class="hover:text-brand-dark smooth-transition">Contact</a>
                <a href="#" class="hover:text-brand-dark smooth-transition">About</a>
            </nav>

            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-brand-dark text-white flex items-center justify-center hover:bg-opacity-90 smooth-transition">
                   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
                <button class="bg-brand-dark text-white px-6 py-2 rounded-full text-sm font-semibold shadow-lg shadow-brand-dark/30 hover:shadow-brand-dark/50 hover:-translate-y-0.5 smooth-transition">
                    Sign Up
                </button>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 pt-32 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h1 class="text-5xl lg:text-7xl font-bold text-brand-dark leading-tight">
                        WINTER <br/> 
                        <span class="text-gray-800">JACKET</span>
                    </h1>
                    <h2 class="text-3xl lg:text-4xl text-brand-green font-light mt-2">STORE</h2>
                </div>
                
                <p class="text-gray-500 leading-relaxed max-w-md">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                </p>

                <button class="bg-[#333] text-white px-8 py-3 rounded-full font-medium hover:bg-black smooth-transition shadow-xl">
                    Get Started
                </button>

                <div class="flex gap-6 mt-12 pt-8">
                    <div class="relative group cursor-pointer">
                        <div class="w-48 h-40 bg-brand-mint rounded-b-[3rem] rounded-t-lg relative overflow-visible flex items-end justify-center pb-4 shadow-sm group-hover:shadow-md smooth-transition">
                             <img src="{{ asset('images/grey-jacket.png') }}" class="absolute -top-10 w-32 drop-shadow-2xl hover:scale-105 smooth-transition">
                            <div class="text-center mt-12">
                                <h3 class="font-bold text-gray-800">Lorem Jacket</h3>
                                <p class="text-xs text-gray-500 mb-1">Waterproof</p>
                                <p class="text-brand-dark font-bold">$105.00</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative group cursor-pointer">
                         <div class="w-48 h-40 bg-brand-mint rounded-b-[3rem] rounded-t-lg relative overflow-visible flex items-end justify-center pb-4 shadow-sm group-hover:shadow-md smooth-transition">
                            <img src="{{ asset('images/brown-jacket.png') }}" class="absolute -top-10 w-32 drop-shadow-2xl hover:scale-105 smooth-transition">
                             <div class="text-center mt-12">
                                <h3 class="font-bold text-gray-800">Ipsum Jacket</h3>
                                <p class="text-xs text-gray-500 mb-1">Waterproof</p>
                                <p class="text-brand-dark font-bold">$75.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 relative flex justify-center items-center">
                <div class="absolute bg-brand-mint w-[90%] h-[90%] rounded-full opacity-60 -z-10 translate-y-10"></div>
                
                <div class="relative w-full max-w-lg z-10">
                    <img src="https://via.placeholder.com/500x600/40513B/fff?text=Main+Winter+Jacket" alt="Main Winter Jacket" class="w-full drop-shadow-2xl object-contain hover:scale-105 smooth-transition duration-500">
                </div>

                <div class="absolute w-full flex justify-between items-center px-4 md:px-12 z-20 top-1/2 -translate-y-1/2">
                    <button class="w-12 h-12 bg-brand-dark text-white rounded-full flex items-center justify-center hover:bg-gray-800 smooth-transition shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="w-12 h-12 bg-brand-dark text-white rounded-full flex items-center justify-center hover:bg-gray-800 smooth-transition shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

        </div>
    </main>
</body>
</html>