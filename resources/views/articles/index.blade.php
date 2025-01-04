@extends('layouts.app')
@section('title', 'Winnicode Garuda Teknologi')

@section('content')
<main class="container mx-auto px-4 py-20">
    <h1 class="text-4xl font-bold text-center mb-12" style="color: var(--text-primary);">Artikel Berita</h1>

    <!-- Filter dan Pencarian -->
    <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
        <!-- Filter Kategori -->
        <form action="{{ route('articles.index') }}" method="GET" class="flex items-center space-x-4">
            <select name="category" id="category"
                    class="border rounded px-4 py-2 focus:outline-none"
                    style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="px-4 py-2 rounded hover:shadow-md"
                    style="background-color: var(--button-primary); color: var(--button-text);">
                Filter
            </button>
        </form>

        <!-- Pencarian -->
        <form action="{{ route('articles.index') }}" method="GET" class="flex items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..."
                   class="border rounded px-4 py-2 w-64 focus:outline-none"
                   style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
            <button type="submit"
                    class="ml-2 px-4 py-2 rounded hover:shadow-md"
                    style="background-color: var(--button-primary); color: var(--button-text);">
                Cari
            </button>
        </form>
    </div>

    <!-- Daftar Artikel -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($articles as $article)
            <article class="rounded-lg shadow-lg overflow-hidden transition-all duration-300"
                     style="background-color: var(--background-secondary); color: var(--text-primary);">
                <!-- Gambar -->
                <div class="relative">
                    <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('images/default.jpg') }}"
                         alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 p-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium"
                                  style="background-color: var(--button-primary); color: var(--button-text);">
                                {{ $article->category->name ?? 'Uncategorized' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-6">
                    <h2 class="text-lg font-semibold hover:text-blue-600 transition-colors duration-300">
                        <a href="/article/{{ $article->slug }}" style="color: var(--text-primary);">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <p class="text-sm mt-2" style="color: var(--text-secondary);">
                        {!! Str::limit(strip_tags($article->content), 100) !!}
                    </p>
                    <div class="flex items-center text-sm mt-4" style="color: var(--text-secondary);">
                        <span>{{ $article->author->name ?? 'Unknown' }}</span>
                        <span class="mx-2">•</span>
                        <time>
                            {{ $article->created_at ? $article->created_at->format('d F Y') : 'Date not available' }}
                        </time>
                    </div>
                </div>

                <!-- Read More -->
                <div class="px-6 pb-6 mt-auto">
                    <a href="/article/{{ $article->slug }}"
                       class="inline-block font-medium hover:underline"
                       style="color: var(--text-link);">
                        Baca Selengkapnya &raquo;
                    </a>
                </div>
            </article>
        @empty
            <p class="text-center col-span-3" style="color: var(--text-secondary);">
                Tidak ada artikel yang ditemukan.
            </p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $articles->links() }}
    </div>
</main>

<!-- Tag Artikel -->
@if ($articles->isNotEmpty())
    <p class="text-sm mt-8" style="color: var(--text-secondary);">
        @foreach ($article->tags as $tag)
            <a href="{{ route('articles.index', ['tag' => $tag->name]) }}"
               class="inline-block rounded px-2 py-1 mr-1 text-xs font-medium"
               style="background-color: var(--button-primary); color: var(--button-text);">
                #{{ $tag->name }}
            </a>
        @endforeach
    </p>
@endif
@endsection
