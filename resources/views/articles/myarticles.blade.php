@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-md rounded-lg mt-20">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Artikel Saya</h1>
        <a href="{{ route('articles.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
            Tambah Artikel
        </a>
    </div>

    <!-- Tabel Artikel -->
    <div class="overflow-x-auto mb-12"> <!-- Tambahkan kelas `mb-12` -->
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">Judul</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Gambar</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Kategori</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $article->title }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Artikel" class="w-20 h-20 object-cover rounded-md">
                        @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $article->category->name ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="{{ $article->status === 'published' ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ ucfirst($article->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 flex items-center space-x-2">
                        <a href="{{ route('articles.edit', $article->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                        @if ($article->status === 'draft')
                        <form action="{{ route('articles.publish', $article->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-green-600 hover:underline">Publish</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border border-gray-300 px-4 py-2 text-center text-gray-500">Tidak ada artikel</td>
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
