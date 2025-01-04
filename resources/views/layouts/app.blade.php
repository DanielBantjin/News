<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Winnicode Garuda')</title>

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-dyB87XVDubHV2BY5KhQFpjE0kpqMJjD8QMWiMEFQhOS1wRlI65uq4DHfQzftjPYy" crossorigin="anonymous">

    <!-- Swiper.js for Carousels -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Theme Initialization -->
    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.className = theme;
    </script>
</head>
<body class="bg-[var(--background-primary)] text-[var(--text-primary)]">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content Wrapper -->
    <main class="py-12 px-6" style="background-color: var(--background-primary); color: var(--text-primary); min-height: calc(100vh - 200px);">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Theme Toggle Button -->
    <div class="fixed bottom-4 right-4">
        <button onclick="toggleTheme()" 
                class="bg-[var(--button-primary)] text-[var(--button-text)] p-3 rounded-full shadow-md">
            <span id="theme-icon">🌙</span>
        </button>
    </div>

    <!-- Theme Toggle Script -->
    <script>
        function toggleTheme() {
            const currentTheme = document.documentElement.className;
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.className = newTheme;
            localStorage.setItem('theme', newTheme);
            document.getElementById('theme-icon').textContent = newTheme === 'dark' ? '☀️' : '🌙';
        }
    </script>

    <!-- Swiper.js -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
