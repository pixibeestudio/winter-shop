@extends('layouts.app')

@section('title', 'Register - Winter Store')

@section('content')
<div class="min-h-screen flex flex-row-reverse">
    
    <div class="hidden lg:block w-1/2 bg-cover bg-center relative" 
         style="background-image: url('https://images.unsplash.com/photo-1515434126000-961d90c046e7?q=80&w=1920&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute bottom-20 right-10 text-white p-10 text-right">
            <h2 class="text-4xl font-bold mb-4">Join the Club</h2>
            <p class="text-lg opacity-90">Get exclusive access to new arrivals and sales.</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-white p-8 sm:p-20">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center lg:text-left">
                <h1 class="text-4xl font-bold text-brand-dark mb-2">Create Account</h1>
                <p class="text-gray-500">Join us to start your premium journey.</p>
            </div>

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all" placeholder="John Doe">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all" placeholder="you@example.com">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 flex justify-between">
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" id="regPass" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-all pr-12" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('regPass', 'regEye')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-black focus:outline-none p-1">
                            <div id="regEye">
                                <svg class="w-5 h-5 block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full bg-black text-white py-4 rounded-full font-bold text-lg hover:bg-gray-800 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                    Create Account
                </button>
            </form>

            <div class="text-center text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-black hover:underline">Sign In</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Dùng chung hàm togglePassword giống trang Login
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const iconContainer = document.getElementById(iconId);
        if (input.type === "password") {
            input.type = "text";
            iconContainer.innerHTML = `<svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>`;
        } else {
            input.type = "password";
            iconContainer.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>`;
        }
    }
</script>
@endsection