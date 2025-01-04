@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="container mx-auto px-4 py-20">
    <h1 class="text-4xl font-bold mb-6" style="color: var(--text-primary);">{{ $blog->title }}</h1>

    <div class="text-sm mb-6" style="color: var(--text-secondary);">
        <span>Oleh {{ $blog->author->name }}</span>
        <span class="mx-2">•</span>
        <span>{{ $blog->published_at->format('d F Y') }}</span>
    </div>

    @if ($blog->image)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full rounded-lg shadow-md">
        </div>
    @endif

    <div class="prose prose-lg max-w-none" style="color: var(--text-primary);">
        {!! $blog->content !!}
    </div>
</div>
@endsection
