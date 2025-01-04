@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="max-w-4xl mx-auto p-6 rounded-lg shadow-md mt-20" 
     style="background-color: var(--background-secondary); color: var(--text-primary);">
    <h1 class="text-3xl font-bold mb-6" style="color: var(--text-primary);">Tambah Artikel</h1>

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Judul -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">Judul Artikel</label>
            <input type="text" name="title" id="title" 
                   class="block w-full border rounded-md shadow-sm p-2 focus:outline-none"
                   style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);" 
                   value="{{ old('title') }}" required>
            @error('title')
                <span class="text-sm" style="color: var(--text-error);">{{ $message }}</span>
            @enderror
        </div>

        <!-- Konten -->
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">Konten</label>
            <textarea name="content" id="content" rows="8"
                      class="block w-full border rounded-md shadow-sm p-2 focus:outline-none"
                      style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">{{ old('content') }}</textarea>
            @error('content')
                <span class="text-sm" style="color: var(--text-error);">{{ $message }}</span>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">Kategori</label>
            <select name="category_id" id="category_id"
                    class="block w-full border rounded-md shadow-sm p-2 focus:outline-none"
                    style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);" 
                    required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-sm" style="color: var(--text-error);">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tag -->
        <div class="mb-4">
            <label for="tags" class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">Tag</label>
            <input type="text" name="tags" id="tags"
                   class="block w-full border rounded-md shadow-sm p-2 focus:outline-none"
                   style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);" 
                   placeholder="Tambahkan tag, pisahkan dengan koma (misal: teknologi, berita, olahraga)"
                   value="{{ old('tags') }}">
        </div>

        <!-- Gambar -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium mb-1" style="color: var(--text-secondary);">Unggah Gambar</label>
            <input type="file" name="image" id="image"
                   class="block w-full border rounded-md shadow-sm p-2 focus:outline-none"
                   style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
            @error('image')
                <span class="text-sm" style="color: var(--text-error);">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" 
                class="px-4 py-2 rounded-md transition duration-300 hover:shadow-md"
                style="background-color: var(--button-primary); color: var(--button-text);">
            Simpan Artikel
        </button>
    </form>
</div>

<!-- Integrasi TinyMCE -->
<script src="https://cdn.tiny.cloud/1/ll3jubzwzn2402s9dzabf7sutbrnyaylc7470dlc88b9qgi6/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content', 
        plugins: 'lists link image table code help', 
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image table | code',
        menubar: false,
        branding: false,
        forced_root_block: false,
        valid_elements: '*[*]',
        content_style: 'body { font-family:Arial,sans-serif; font-size:14px; color: var(--text-primary); background-color: var(--background-primary); }',
        skin: 'oxide-dark', // Menyesuaikan tema untuk Dark Mode
        content_css: false
    });
</script>
@endsection
