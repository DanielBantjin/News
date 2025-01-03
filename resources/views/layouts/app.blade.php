<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      class="{{ auth()->check() && auth()->user()->theme_preference == 'dark' ? 'dark' : (session('theme') == 'dark' ? 'dark' : '') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Garuda Teknologi Indonesia')</title>

    <!-- Styles -->
    @vite('resources/css/app.css')

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Swiper.js for carousels -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js"></script>

</head>

<body class="h-full bg-white dark:bg-gray-900" x-data="{ theme: localStorage.getItem('theme') || '{{ auth()->user()->theme_preference ?? 'light' }}' }" x-init="if (theme === 'dark') { document.documentElement.classList.add('dark'); } else { document.documentElement.classList.remove('dark'); }">

    <!-- Navbar -->
    @include('components.navbar') 

    <div class="content">
        @yield('content') 
    </div>

    @yield('scripts')

    <footer>
        @include('components.footer')
    </footer>

    <!-- Theme Switcher (Optional) -->
    <div class="fixed bottom-4 right-4">
        <button @click="theme = (theme === 'dark' ? 'light' : 'dark'); localStorage.setItem('theme', theme); document.documentElement.classList.toggle('dark', theme === 'dark');"
                class="bg-indigo-600 text-white p-3 rounded-full shadow-md focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3v2m0 10v2m5-5h2m-10 0H3m14.828-7.828l-1.414 1.414M6.343 5.343l-1.414 1.414M18.364 18.364l-1.414-1.414M5.343 18.364l1.414-1.414"></path>
            </svg>
        </button>
    </div>
</body>
</html>
