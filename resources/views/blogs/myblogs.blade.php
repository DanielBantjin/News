@extends('layouts.app')

@section('title', 'Blog Saya')

@section('content')
    <div class="container mx-auto px-4 py-20">
        <h1 class="text-3xl font-bold text-white mb-8">Blog Saya</h1>

        <!-- Tombol Tambah Blog -->
        <div class="mb-6">
            <a href="{{ route('myblogs.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                Tambah Blog Baru
            </a>
        </div>

        <!-- Cek apakah pengguna memiliki blog -->
        @if ($blogs->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($blogs as $blog)
                    <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <!-- Judul Blog -->
                        <h2 class="text-lg font-bold text-white mb-2">{{ $blog->title }}</h2>

                        <!-- Kategori -->
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-2 inline-block">
                            {{ $blog->category->name ?? 'Tanpa Kategori' }}
                        </span>

                        <!-- Status -->
                        <p class="text-sm text-gray-400 mb-2">
                            Status:
                            <span class="{{ $blog->status === 'published' ? 'text-green-400' : 'text-yellow-400' }}">
                                {{ ucfirst($blog->status) }}
                            </span>
                        </p>

                        <!-- Konten Singkat -->
                        <p class="text-gray-400 mb-4">{{ Str::limit($blog->content, 100) }}</p>

                        <!-- Aksi -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="text-blue-400 hover:underline">
                                Lihat Selengkapnya
                            </a>
                            <div class="flex space-x-2">
                                @if ($blog->status === 'draft')
                                    <form action="{{ route('myblogs.publishDraft') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $blog->id }}">
                                        <button type="submit" class="text-green-400 hover:underline">
                                            Publikasikan
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('myblogs.edit', $blog->id) }}" class="text-yellow-400 hover:underline">
                                    Edit
                                </a>
                                <form action="{{ route('myblogs.destroy', $blog->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus blog ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
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
        @endif
    </div>
@endsection
