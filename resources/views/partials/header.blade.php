<header class="fixed w-full top-0 z-50 bg-white border-b border-gray-100 transition-all duration-300" id="main-header">
    <div class="container mx-auto px-6 h-20 flex justify-between items-center relative">
        
        <div class="lg:hidden flex items-center">
            <button type="button" onclick="toggleMobileMenu()" class="text-gray-900 focus:outline-none p-2 hover:bg-gray-100 rounded-md">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>

        <a href="/" class="flex items-center gap-2 group absolute left-1/2 transform -translate-x-1/2 lg:static lg:transform-none lg:left-auto">
            <span class="font-serif text-3xl font-bold tracking-tight text-gray-900 italic">Winter<span class="text-brand-dark not-italic">Store</span></span>
        </a>

        <nav class="hidden lg:flex gap-8 text-sm font-bold uppercase tracking-widest text-gray-600">
            <a href="/" class="hover:text-brand-dark transition-colors py-8">Home</a>
            <a href="{{ route('shop.index') }}" class="hover:text-brand-dark transition-colors py-8">Shop</a>
            <a href="{{ route('shop.index', ['sort' => 'newest']) }}" class="hover:text-brand-dark transition-colors py-8">New Arrivals</a>
            <a href="#" class="hover:text-brand-dark transition-colors py-8">Stories</a>
        </nav>

        <div class="flex items-center gap-4 md:gap-5">
            <button onclick="toggleSearch(true)" class="text-gray-900 hover:text-brand-dark transition-colors p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>

            <button onclick="toggleCart(true)" class="relative text-gray-900 hover:text-brand-dark transition-colors p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="absolute top-0 right-0 w-4 h-4 bg-brand-dark text-white text-[10px] font-bold flex items-center justify-center rounded-full">
                    {{ count(session('cart', [])) }}
                </span>
            </button>

            @auth
                <div class="relative group h-20 flex items-center">
                    <button class="text-gray-900 hover:text-brand-dark transition-colors flex items-center gap-2 py-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </button>
                    <div class="absolute right-0 top-full pt-0 w-56 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50">
                        <div class="bg-white shadow-xl border border-gray-100 py-2">
                            <div class="px-4 py-3 border-b border-gray-50 bg-gray-50">
                                <p class="text-xs text-gray-500">Signed in as</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            </div>
                            @if(Str::lower(Auth::user()->email) === 'admin@gmail.com')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-dark">Admin Dashboard</a>
                            @endif
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-dark">My Orders</a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-wider hover:text-brand-dark">Login</a>
            @endauth
        </div>
    </div>

    <div id="mobile-menu" class="fixed inset-0 z-[60] bg-white transform -translate-x-full transition-transform duration-300 lg:hidden flex flex-col">
        <div class="h-20 flex justify-between items-center px-6 border-b border-gray-100">
            <span class="font-serif text-2xl font-bold italic">Menu</span>
            <button type="button" onclick="toggleMobileMenu()" class="p-2 text-gray-500 hover:text-black">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-6 space-y-2">
            <a href="/" class="block py-3 text-lg font-bold text-gray-900 border-b border-gray-50">Home</a>
            <a href="{{ route('shop.index') }}" class="block py-3 text-lg font-bold text-gray-900 border-b border-gray-50">Shop</a>
            <a href="#" class="block py-3 text-lg font-bold text-gray-900 border-b border-gray-50">Products</a>
            <a href="#" class="block py-3 text-lg font-bold text-gray-900 border-b border-gray-50">Blog</a>
        </div>
        <div class="p-6 bg-gray-50">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full bg-red-600 text-white py-3 font-bold rounded-lg">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full bg-black text-white text-center py-3 rounded-lg font-bold uppercase tracking-widest">Login / Register</a>
            @endauth
        </div>
    </div>

    <div id="search-overlay" class="fixed inset-0 bg-white z-[70] hidden flex-col animate-fade-in">
        <button onclick="toggleSearch(false)" class="absolute top-6 right-6 p-2 text-gray-500 hover:text-black transition-transform hover:rotate-90">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="flex-1 flex flex-col items-center justify-center px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 tracking-tight">What are you looking for?</h2>
            <form action="{{ route('shop.index') }}" method="GET" class="w-full max-w-3xl relative group">
                <input type="text" name="search" class="w-full bg-transparent border-b-2 border-gray-200 py-4 text-xl md:text-3xl font-medium text-gray-900 placeholder-gray-300 focus:outline-none focus:border-brand-dark transition-colors text-center" placeholder="Search for products..." autocomplete="off">
                <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 group-hover:text-brand-dark transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    // Hàm bật tắt Mobile Menu
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        // Kiểm tra xem menu có class ẩn không, nếu có thì xóa đi để hiện, và ngược lại
        if (menu.classList.contains('-translate-x-full')) {
            menu.classList.remove('-translate-x-full');
        } else {
            menu.classList.add('-translate-x-full');
        }
    }

    // Hàm bật tắt Search
    function toggleSearch(show) {
        const overlay = document.getElementById('search-overlay');
        const input = overlay.querySelector('input');
        if (show) {
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            setTimeout(() => input.focus(), 100);
        } else {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
        }
    }
</script>