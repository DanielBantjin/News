<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- GSAP for animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-black min-h-screen">
    <nav x-data="{
        isOpen: false,
        isProfileOpen: false,
        scrolled: false,
        currentPath: window.location.pathname
    }" @scroll.window="scrolled = window.pageYOffset > 20"
        :class="{ 'backdrop-blur-md': scrolled, 'bg-transparent': !scrolled }"
        class="fixed w-full top-0 z-50 transition-all duration-300"
        style="background-color: var(--background-secondary); color: var(--text-primary);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-20">
                <!-- Logo Section -->
                <div class="flex-shrink-0 flex items-center">
                    <div class="flex items-center gap-3">
                        <img class="h-10 w-10 rounded-lg object-cover" src="/img/logo.png" alt="Logo">
                        <span class="font-bold text-lg tracking-tight">
                            Winnicode
                            <span class="bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">
                                Garuda
                            </span>
                        </span>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-6">
                    <template
                        x-for="(item, index) in [
                        { name: 'Beranda', path: '/' },
                        { name: 'Artikel', path: '/articles' },
                        { name: 'Blog', path: '/blogs' }
                    ]">
                        <a :href="item.path"
                            class="relative group px-4 py-2 text-sm font-medium transition duration-300"
                            style="color: var(--text-primary);"
                            :class="{ 'text-[var(--text-link)]': currentPath === item.path }">
                            <span x-text="item.name"></span>
                            <div class="absolute bottom-0 left-0 h-0.5 w-0 bg-gradient-to-r from-pink-500 to-purple-500 group-hover:w-full transition-all duration-300"
                                :class="{ 'w-full': currentPath === item.path }"></div>
                        </a>
                    </template>
                </div>

                <!-- Login/Logout/Profile -->
                <div class="relative" @click.away="isProfileOpen = false">
                    @if (auth()->check())
                        <!-- Profile Button -->
                        <button @click="isProfileOpen = !isProfileOpen" class="relative flex items-center group">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-white/20"
                                src="{{ Auth::user()->profile_picture_url ? asset(Auth::user()->profile_picture_url) : asset('images/default-profile.png') }}"
                                alt="Foto Profil">
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="isProfileOpen" x-transition
                            class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg border border-white/10"
                            style="background-color: var(--background-secondary); color: var(--text-primary);">
                            <a href="/profile" class="block px-4 py-2 text-sm hover:bg-gray-700">Profil</a>
                            <a href="/myarticle" class="block px-4 py-2 text-sm hover:bg-gray-700">Artikel Saya</a>
                            <a href="/myblogs" class="block px-4 py-2 text-sm hover:bg-gray-700">Blog Saya</a>
                            <a href="/settings" class="block px-4 py-2 text-sm hover:bg-gray-700">Pengaturan</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-700">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Login Button -->
                        <a href="{{ route('login') }}"
                            class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition">
                            Login
                        </a>
                    @endif
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="isOpen" x-transition class="md:hidden px-2 pt-2 pb-3 space-y-1 bg-gray-900 rounded-lg">
                <template
                    x-for="(item, index) in [
                    { name: 'Beranda', path: '/' },
                    { name: 'Artikel', path: '/articles' },
                    { name: 'Blog', path: '/blogs' }
                ]">
                    <a :href="item.path"
                        class="block px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-gray-700"
                        :class="{ 'bg-gray-700': currentPath === item.path }" x-text="item.name"></a>
                </template>
            </div>
        </div>
    </nav>
</body>

</html>
