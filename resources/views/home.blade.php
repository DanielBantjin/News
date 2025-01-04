@extends('layouts.app')

@section('title', 'Winnicode Garuda Teknologi')

@section('content')
<main class="pt-24 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" style="background-color: var(--background-primary); color: var(--text-primary);">
    <!-- Hot News Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6" style="color: var(--text-primary);">Hot News</h2>

        <!-- Swiper Carousel -->
        <div class="swiper hotNewsSwiper">
            <div class="swiper-wrapper">
                @foreach ($hotNews as $news)
                    <div class="swiper-slide">
                        <div class="relative group rounded-xl overflow-hidden">
                            <!-- Gambar -->
                            <img src="{{ $news->image ? asset('storage/' . $news->image) : asset('images/default.jpg') }}"
                                alt="{{ $news->title }}" class="w-full h-64 object-cover">

                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent">
                                <div class="absolute bottom-0 p-6">
                                    <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">{{ $news->title }}</h3>
                                    <p class="text-sm" style="color: var(--text-secondary);">
                                        {{ Str::limit(strip_tags($news->content), 100) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Trending Tags Section -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4" style="color: var(--text-primary);">Trending Tag</h2>
        <div class="flex flex-wrap gap-4">
            @foreach ($trendingTags as $tag)
                <a href="{{ route('articles.index', ['tag' => $tag->name]) }}"
                    class="px-4 py-2 rounded-full shadow-md hover:shadow-lg"
                    style="background-color: var(--background-secondary); color: var(--text-primary);">
                    #{{ $tag->name }} <span class="text-sm" style="color: var(--text-secondary);">{{ $tag->articles_count }} posts</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Trending Topic Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6" style="color: var(--text-primary);">Trending Topics</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($trendingTopics as $topic)
                <div class="p-4 rounded-lg shadow-lg hover:shadow-xl"
                     style="background-color: var(--background-secondary); color: var(--text-primary);">
                    <a href="{{ route('articles.show', $topic->slug) }}" class="block">
                        <h3 class="font-bold text-lg">{{ $topic->title }}</h3>
                        <p class="text-sm" style="color: var(--text-secondary);">
                            {{ Str::limit(strip_tags($topic->content), 100) }}
                        </p>
                        <div class="text-sm mt-2" style="color: var(--text-secondary);">
                            <span>{{ $topic->views }} views</span>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-gray-400">Belum ada trending topic.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Inisialisasi Swiper.js
        if (document.querySelector('.hotNewsSwiper')) {
            new Swiper('.hotNewsSwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    }
                }
            });
        }

        // GSAP Animations
        gsap.from("nav", {
            y: -100,
            opacity: 0,
            duration: 1,
            ease: "power3.out"
        });

        gsap.from("main > section", {
            y: 50,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out"
        });
    });
</script>
@endsection
