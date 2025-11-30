<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Winter Jacket Store')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-gray-800 antialiased overflow-x-hidden flex flex-col min-h-screen">

    @include('partials.header')

    <main class="flex-grow pt-20"> 
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>