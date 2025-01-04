@extends('layouts.app')

@section('title', 'Tambah Blog')

@section('content')
<div class="container mx-auto px-4 py-20">
    <h1 class="text-3xl font-bold mb-8" style="color: var(--text-primary);">Tambah Blog</h1>

    <form action="{{ route('myblogs.storeDraft') }}" method="POST" enctype="multipart/form-data" style="background-color: var(--background-secondary); color: var(--text-primary); padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        @csrf
        <div class="mb-4">
            <label for="title" class="block mb-2" style="color: var(--text-secondary);">Judul</label>
            <input type="text" name="title" class="w-full border px-4 py-2 rounded" style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);" required>
        </div>

        <div class="mb-4">
            <label for="content" class="block mb-2" style="color: var(--text-secondary);">Konten</label>
            <textarea id="content-editor" name="content" rows="6" class="w-full border px-4 py-2 rounded" style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);"></textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block mb-2" style="color: var(--text-secondary);">Kategori</label>
            <select name="category_id" class="w-full border px-4 py-2 rounded" style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block mb-2" style="color: var(--text-secondary);">Gambar</label>
            <input type="file" name="image" class="w-full border px-4 py-2 rounded" style="background-color: var(--background-primary); color: var(--text-primary); border-color: var(--text-secondary);">
        </div>

        <button type="submit" class="px-4 py-2 rounded" style="background-color: var(--button-primary); color: var(--button-text);">Simpan Draft</button>
    </form>
</div>
@endsection

@section('scripts')
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/ll3jubzwzn2402s9dzabf7sutbrnyaylc7470dlc88b9qgi6/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        tinymce.init({
            selector: '#content-editor', // Target textarea dengan ID "content-editor"
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                      alignleft aligncenter alignright alignjustify | \
                      bullist numlist outdent indent | removeformat | help',
            content_style: 'body { font-family:Arial,sans-serif; font-size:14px; color: var(--text-primary); background-color: var(--background-primary); }',
            skin: 'oxide-dark', // Menyesuaikan tema untuk Dark Mode
            content_css: false
        });
    });
</script>
@endsection
