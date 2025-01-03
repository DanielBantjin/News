@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Artikel -->
    <article class="pt-12">
        <!-- Judul -->
        <h1 class="text-4xl font-bold text-white mb-4">{{ $article->title }}</h1>

        <!-- Metadata -->
        <div class="flex items-center text-gray-300 text-sm mb-4">
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
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="rounded-lg shadow-md">
            </div>
        @endif

        <!-- Konten -->
        <div class="prose max-w-none text-white">
            {!! $article->content !!}
        </div>

        <!-- Tags -->
        @if ($article->tags->count() > 0)
            <div class="mt-6">
                <h3 class="text-lg font-bold text-white mb-2">Tags:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($article->tags as $tag)
                        <a href="{{ route('articles.index', ['tag' => $tag->name]) }}" class="bg-gray-800 text-white px-3 py-1 rounded-full text-sm hover:bg-gray-700">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>

    <!-- Tombol Kembali -->
    <div class="mt-6">
        <a href="{{ route('articles.index') }}" class="text-blue-400 hover:underline">&larr; Kembali ke Daftar Artikel</a>
    </div>
</div>
@endsection
