@extends('layouts.app')

@section('title', 'Daftar Artikel Saya')

@section('content')
<div class="max-w-7xl mx-auto p-6 rounded-lg shadow-md mt-20"
     style="background-color: var(--background-secondary); color: var(--text-primary);">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold" style="color: var(--text-primary);">Daftar Artikel Saya</h1>
        <a href="{{ route('articles.create') }}"
           class="px-4 py-2 rounded-md transition hover:shadow-md"
           style="background-color: var(--button-primary); color: var(--button-text);">
            Tambah Artikel
        </a>
    </div>

    <!-- Tabel Artikel -->
    <div class="overflow-x-auto mb-12">
        <table class="table-auto w-full border-collapse border"
               style="border-color: var(--text-secondary);">
            <thead style="background-color: var(--background-primary); color: var(--text-primary);">
                <tr>
                    <th class="border px-4 py-2 text-left" style="border-color: var(--text-secondary);">Judul</th>
                    <th class="border px-4 py-2 text-left" style="border-color: var(--text-secondary);">Gambar</th>
                    <th class="border px-4 py-2 text-left" style="border-color: var(--text-secondary);">Kategori</th>
                    <th class="border px-4 py-2 text-left" style="border-color: var(--text-secondary);">Status</th>
                    <th class="border px-4 py-2 text-left" style="border-color: var(--text-secondary);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                <tr class="hover:bg-opacity-10 transition-all"
                    style="background-color: var(--background-primary); color: var(--text-primary);">
                    <td class="border px-4 py-2" style="border-color: var(--text-secondary);">
                        {{ $article->title }}
                    </td>
                    <td class="border px-4 py-2" style="border-color: var(--text-secondary);">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Artikel"
                                 class="w-20 h-20 object-cover rounded-md">
                        @else
                            <span style="color: var(--text-secondary);">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2" style="border-color: var(--text-secondary);">
                        {{ $article->category->name ?? 'N/A' }}
                    </td>
                    <td class="border px-4 py-2" style="border-color: var(--text-secondary);">
                        <span class="{{ $article->status === 'published' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ ucfirst($article->status) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2 flex items-center space-x-2" style="border-color: var(--text-secondary);">
                        <a href="{{ route('articles.edit', $article->id) }}" class="hover:underline"
                           style="color: var(--text-link);">Edit</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:underline" style="color: var(--text-error);">Hapus</button>
                        </form>
                        @if ($article->status === 'draft')
                        <form action="{{ route('articles.publish', $article->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="hover:underline" style="color: var(--text-success);">Publish</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border px-4 py-2 text-center"
                        style="border-color: var(--text-secondary); color: var(--text-secondary);">
                        Tidak ada artikel
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
@endsection
