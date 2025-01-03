@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
    <div class="container mx-auto px-4 py-20">
        <h1 class="text-3xl font-bold text-center text-white mb-8">Edit Artikel</h1>

        <!-- Form Edit Artikel -->
        <div class="bg-white shadow-md rounded-lg p-6">
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-500 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Judul Artikel</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-4 py-2"
                        required>
                </div>

                <!-- Konten -->
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-medium mb-2">Konten</label>
                    <textarea name="content" id="content" rows="8"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-4 py-2" required>{{ old('content', $article->content) }}</textarea>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori</label>
                    <select name="category_id" id="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-4 py-2"
                        required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Gambar -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-medium mb-2">Gambar (Opsional)</label>
                    @if ($article->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Artikel"
                                class="w-32 h-32 object-cover rounded-md">
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 px-4 py-2">
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 shadow-md">
                        Perbarui Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mb-4">
        <label for="tags" class="block text-sm font-medium text-gray-700">Tag</label>
        <input type="text" name="tags" id="tags" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
            placeholder="Tambahkan tag, pisahkan dengan koma (misal: teknologi, berita, olahraga)" 
            value="{{ old('tags', $article->tags->pluck('name')->implode(', ')) }}">
    </div>
    

    <!-- Integrasi TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/ll3jubzwzn2402s9dzabf7sutbrnyaylc7470dlc88b9qgi6/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content', // Targetkan elemen dengan ID 'content'
            plugins: 'lists link image table code help', // Tambahkan plugin yang Anda perlukan
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code',
            menubar: false, // Hapus menubar untuk tampilan sederhana
            branding: false // Hapus branding TinyMCE
        });
    </script>
@endsection
