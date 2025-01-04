@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8"
     style="background-color: var(--background-secondary); color: var(--text-primary);">
    <!-- Artikel -->
    <article class="pt-12">
        <!-- Judul -->
        <h1 class="text-4xl font-bold mb-4" style="color: var(--text-primary);">{{ $article->title }}</h1>

        <!-- Metadata -->
        <div class="flex items-center text-sm mb-4" style="color: var(--text-secondary);">
            <span>Oleh {{ $article->author->name ?? 'Unknown' }}</span>
            <span class="mx-2">•</span>
            <time>
                {{ $article->published_at ? $article->published_at->format('d F Y') : 'Tanggal tidak tersedia' }}
            </time>
            <span class="mx-2">•</span>
            <span>{{ $article->views }} views</span>
        </div>

        <!-- Gambar -->
        @if ($article->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" 
                     class="rounded-lg shadow-md">
            </div>
        @endif

        <!-- Konten -->
        <div class="prose max-w-none" style="color: var(--text-primary);">
            {!! $article->content !!}
        </div>

        <!-- Tags -->
        @if ($article->tags->count() > 0)
            <div class="mt-6">
                <h3 class="text-lg font-bold mb-2" style="color: var(--text-secondary);">Tags:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($article->tags as $tag)
                        <a href="{{ route('articles.index', ['tag' => $tag->name]) }}"
                           class="px-3 py-1 rounded-full text-sm transition hover:shadow-md"
                           style="background-color: var(--button-primary); color: var(--button-text);">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>

    <!-- Tombol Kembali -->
    <div class="mt-6">
        <a href="{{ route('articles.index') }}" 
           class="text-blue-400 hover:underline transition" 
           style="color: var(--text-link);">
            &larr; Kembali ke Daftar Artikel
        </a>
    </div>
</div>
@endsection
