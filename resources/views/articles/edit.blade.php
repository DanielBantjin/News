@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="container mx-auto px-4 py-20">
    <h1 class="text-3xl font-bold text-center mb-8" style="color: var(--text-primary);">Edit Artikel</h1>

    <!-- Form Edit Artikel -->
    <div class="p-6 rounded-lg shadow-md" 
         style="background-color: var(--background-secondary); color: var(--text-primary);">
        @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-sm" style="color: var(--text-error);">
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
                <label for="title" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">
                    Judul Artikel
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}"
                       class="w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                       style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);" 
                       required>
            </div>

            <!-- Konten -->
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">
                    Konten
                </label>
                <textarea name="content" id="content" rows="8" 
                          class="w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                          style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);"
                          required>{{ old('content', $article->content) }}</textarea>
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">
                    Kategori
                </label>
                <select name="category_id" id="category_id" 
                        class="w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                        style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);"
                        required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Gambar -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">
                    Gambar (Opsional)
                </label>
                @if ($article->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Artikel"
                             class="w-32 h-32 object-cover rounded-md shadow">
                    </div>
                @endif
                <input type="file" name="image" id="image" 
                       class="w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                       style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
            </div>

            <!-- Tag -->
            <div class="mb-4">
                <label for="tags" class="block text-sm font-medium mb-2" style="color: var(--text-secondary);">
                    Tag
                </label>
                <input type="text" name="tags" id="tags" 
                       class="w-full border rounded-lg shadow-sm p-2 focus:outline-none"
                       style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);"
                       placeholder="Tambahkan tag, pisahkan dengan koma (misal: teknologi, berita, olahraga)"
                       value="{{ old('tags', $article->tags->pluck('name')->implode(', ')) }}">
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-2 rounded-lg transition duration-300 hover:shadow-md"
                        style="background-color: var(--button-primary); color: var(--button-text);">
                    Perbarui Artikel
                </button>
            </div>
        </form>
    </div>
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
        content_style: 'body { font-family:Arial,sans-serif; font-size:14px; color: var(--text-primary); background-color: var(--background-primary); }',
        skin: 'oxide-dark', 
        content_css: false
    });
</script>
@endsection
