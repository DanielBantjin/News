@extends('layouts.app')
@section('title', $article->title)

@section('content')
<main class="container mx-auto px-4 py-20">
    <article class="max-w-3xl mx-auto rounded-xl shadow-lg overflow-hidden" style="background-color: var(--background-secondary); color: var(--text-primary);">
        <!-- Gambar Artikel -->
        @if ($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" 
                 alt="{{ $article->title }}" 
                 class="w-full h-64 object-cover">
        @else
            <img src="{{ asset('images/default.jpg') }}" 
                 alt="Default Image" 
                 class="w-full h-64 object-cover">
        @endif

        <div class="p-6">
            <!-- Judul Artikel -->
            <header class="mb-6">
                <h1 class="text-4xl font-bold mb-4">{{ $article->title }}</h1>
                <div class="mt-2 text-sm flex flex-wrap items-center gap-2" style="color: var(--text-secondary);">
                    <span>Ditulis oleh: <strong>{{ $article->author->name ?? 'Tidak diketahui' }}</strong></span>
                    <span class="mx-2">•</span>
                    <time>
                        {{ $article->published_at ? $article->published_at->format('d F Y') : 'Tanggal tidak tersedia' }}
                    </time>
                </div>
                <div class="mt-2">
                    <span class="inline-block px-3 py-1 text-xs font-medium rounded-full"
                          style="background-color: var(--button-primary); color: var(--button-text);">
                        {{ $article->category->name ?? 'Tanpa Kategori' }}
                    </span>
                </div>
            </header>

            <!-- Konten Artikel -->
            <section class="leading-relaxed" style="color: var(--text-secondary);">
                {!! nl2br(e($article->content)) !!}
            </section>

            <!-- Informasi Tambahan -->
            <footer class="mt-8 text-sm" style="color: var(--text-secondary);">
                <p>Dipublikasikan pada: 
                    {{ $article->created_at ? $article->created_at->format('d F Y') : 'Tanggal tidak tersedia' }}
                </p>
                @if ($article->updated_at && $article->updated_at != $article->created_at)
                    <p>Terakhir diperbarui pada: {{ $article->updated_at->format('d F Y') }}</p>
                @endif
            </footer>

            <!-- Navigasi Kembali -->
            <div class="mt-6">
                <a href="{{ route('articles.index') }}" 
                   class="hover:underline"
                   style="color: var(--text-link);">
                   « Kembali ke Artikel
                </a>
            </div>
        </div>
    </article>
</main>
@endsection
