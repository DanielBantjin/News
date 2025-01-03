@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="container mx-auto px-4 py-20">
    <h1 class="text-4xl font-bold text-white mb-6">{{ $blog->title }}</h1>

    <div class="text-gray-500 mb-6">
        <span>Oleh {{ $blog->author->name }}</span>
        <span class="mx-2">•</span>
        <span>{{ $blog->published_at->format('d F Y') }}</span>
    </div>

    @if ($blog->image)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full rounded-lg">
        </div>
    @endif

    <div class="prose prose-lg text-white">
        {!! $blog->content !!}
    </div>
</div>
@endsection
