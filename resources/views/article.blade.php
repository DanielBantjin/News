@extends('layouts.app')
@section('title', $article->title)

@section('content')
<main class="container mx-auto px-4 py-20">
    <article class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
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
                <h1 class="text-4xl font-bold text-gray-800">{{ $article->title }}</h1>
                <div class="mt-2 text-sm text-gray-500 flex flex-wrap items-center gap-2">
                    <span>Ditulis oleh: <strong>{{ $article->author->name ?? 'Tidak diketahui' }}</strong></span>
                    <span class="mx-2">•</span>
                    <time>
                        {{ $article->published_at ? $article->published_at->format('d F Y') : 'Tanggal tidak tersedia' }}
                    </time>
                </div>
                <div class="mt-2">
                    <span class="inline-block px-3 py-1 bg-blue-500 text-white text-xs font-medium rounded-full">
                        {{ $article->category->name ?? 'Tanpa Kategori' }}
                    </span>
                </div>
            </header>

            <!-- Konten Artikel -->
            <section class="text-gray-700 leading-relaxed">
                {!! nl2br(e($article->content)) !!}
            </section>

            <!-- Informasi Tambahan -->
            <footer class="mt-8 text-sm text-gray-500">
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
                   class="text-blue-500 hover:underline">
                   « Kembali ke Artikel
                </a>
            </div>
        </div>
    </article>
</main>
@endsection
