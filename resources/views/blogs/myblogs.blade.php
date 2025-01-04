@extends('layouts.app')

@section('title', 'Blog Saya')

@section('content')
<div class="container mx-auto px-4 py-20">
    <h1 class="text-3xl font-bold mb-8" style="color: var(--text-primary);">Blog Saya</h1>

    <!-- Tombol Tambah Blog -->
    <div class="mb-6">
        <a href="{{ route('myblogs.create') }}" class="px-4 py-2 rounded-lg hover:shadow-md"
           style="background-color: var(--button-primary); color: var(--button-text);">
            Tambah Blog Baru
        </a>
    </div>

    <!-- Cek apakah pengguna memiliki blog -->
    @if ($blogs->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($blogs as $blog)
                <div class="p-4 rounded-lg shadow-md"
                     style="background-color: var(--background-secondary); color: var(--text-primary);">
                    <!-- Judul Blog -->
                    <h2 class="text-lg font-bold mb-2">{{ $blog->title }}</h2>

                    <!-- Kategori -->
                    <span class="text-xs px-2 py-1 rounded-full mb-2 inline-block"
                          style="background-color: var(--button-primary); color: var(--button-text);">
                        {{ $blog->category->name ?? 'Tanpa Kategori' }}
                    </span>

                    <!-- Status -->
                    <p class="text-sm mb-2" style="color: var(--text-secondary);">
                        Status:
                        <span style="color: {{ $blog->status === 'published' ? 'var(--text-success)' : 'var(--text-warning)' }};">
                            {{ ucfirst($blog->status) }}
                        </span>
                    </p>

                    <!-- Konten Singkat tanpa tag HTML -->
                    <p class="text-sm mb-4" style="color: var(--text-secondary);">
                        {{ Str::limit(strip_tags($blog->content), 100) }}
                    </p>

                    <!-- Aksi -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="hover:underline"
                           style="color: var(--text-link);">
                            Lihat Selengkapnya
                        </a>
                        <div class="flex space-x-2">
                            @if ($blog->status === 'draft')
                                <form action="{{ route('myblogs.publishDraft') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $blog->id }}">
                                    <button type="submit" class="hover:underline"
                                            style="color: var(--text-success);">
                                        Publikasikan
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('myblogs.edit', $blog->id) }}" class="hover:underline"
                               style="color: var(--text-warning);">
                                Edit
                            </a>
                            <form action="{{ route('myblogs.destroy', $blog->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus blog ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:underline"
                                        style="color: var(--text-error);">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $blogs->links() }}
        </div>
    @else
        <p class="text-gray-400" style="color: var(--text-secondary);">Anda belum memiliki blog. Tambahkan blog baru!</p>
    @endif
</div>
@endsection
