<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Winnicode Garuda')</title>
    @vite('resources/css/app.css')

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
</body>
</html>
