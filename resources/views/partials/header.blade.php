<header
    class="fixed w-full top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
    <div class="container mx-auto px-6 h-20 flex justify-between items-center">
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-8 h-8 rounded-full bg-brand-dark group-hover:bg-brand transition-colors"></div>
            <span class="font-bold text-xl tracking-wide text-brand-dark">WINTER<span
                    class="font-light">STORE</span></span>
        </a>

        <nav class="hidden md:flex gap-8 text-sm font-medium text-gray-500">
            <a href="/" class="text-brand-dark font-semibold">Home</a>
            <a href="#" class="hover:text-brand-dark transition-colors">Shop</a>
            <a href="#" class="hover:text-brand-dark transition-colors">New Arrivals</a>
            <a href="#" class="hover:text-brand-dark transition-colors">Stories</a>
        </nav>

        <div class="flex items-center gap-4">
            <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>

            <button onclick="toggleCart(true)" class="p-2 hover:bg-gray-100 rounded-full transition-colors relative">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <span
                    class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full">0</span>
            </button>

            <button
                class="hidden md:block bg-brand-dark text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-opacity-90 hover:shadow-lg transition-all">
                Login
            </button>
        </div>
    </div>
</header>
