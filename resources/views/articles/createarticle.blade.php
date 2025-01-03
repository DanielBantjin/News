@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-20">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Artikel</h1>

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Judul -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul Artikel</label>
            <input type="text" name="title" id="title" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" 
                   value="{{ old('title') }}" required>
            @error('title')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Konten -->
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
            <textarea name="content" id="content" rows="8"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">{{ old('content') }}</textarea>
            @error('content')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="category_id" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200" 
                    required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tag -->
        <div class="mb-4">
            <label for="tags" class="block text-sm font-medium text-gray-700">Tag</label>
            <input type="text" name="tags" id="tags" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                   placeholder="Tambahkan tag, pisahkan dengan koma (misal: teknologi, berita, olahraga)"
                   value="{{ old('tags') }}">
        </div>

        <!-- Gambar -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Unggah Gambar</label>
            <input type="file" name="image" id="image" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">
            @error('image')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" 
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">Simpan Artikel</button>
    </form>
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
     branding: false, // Hapus branding TinyMCE
     forced_root_block: false, // Mencegah penambahan otomatis tag <p>
     valid_elements: '*[*]', // Izinkan semua elemen untuk mencegah pemotongan tag
 });
</script>
@endsection
