@extends('layouts.app')

@section('title', 'Winnicode Garuda Teknologi')

@section('content')
    <main class="pt-20 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto"
        style="background-color: var(--background-primary); color: var(--text-primary);">
        <!-- Hot News Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6" style="color: var(--text-primary);">Hot News</h2>

            <!-- Swiper Carousel -->
            <div class="swiper hotNewsSwiper">
                <div class="swiper-wrapper">
                    @forelse ($hotNews as $news)
                        <div class="swiper-slide">
                            <a href="{{ route('articles.show', $news->slug) }}"
                                class="block relative group rounded-xl overflow-hidden">
                                <!-- Gambar -->
                                <img src="{{ $news->image ? asset('storage/' . $news->image) : asset('images/default.jpg') }}"
                                    alt="{{ $news->title }}" class="w-full h-64 object-cover">

                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent">
                                    <div class="absolute bottom-0 p-6">
                                        <h3 class="text-xl font-bold mb-2" style="color: var(--text-primary);">
                                            {{ $news->title }}</h3>
                                        <p class="text-sm" style="color: var(--text-secondary);">
                                            {{ Str::limit(strip_tags($news->content), 100) }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="relative group rounded-xl overflow-hidden">
                                <img src="{{ asset('images/default.jpg') }}" alt="No News"
                                    class="w-full h-64 object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-center justify-center">
                                    <p class="text-lg text-white font-bold">No Hot News Available</p>
                                </div>
                            </div>
                        </div>
                    @endforelse
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
                        #{{ $tag->name }} <span class="text-sm"
                            style="color: var(--text-secondary);">{{ $tag->articles_count }} posts</span>
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

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
@endsection

@section('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.hotNewsSwiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    </script>
@endsection
