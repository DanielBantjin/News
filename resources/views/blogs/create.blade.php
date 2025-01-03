@extends('layouts.app')

@section('title', 'Tambah Blog')

@section('content')
    <div class="container mx-auto px-4 py-20">
        <h1 class="text-3xl font-bold text-white mb-8">Tambah Blog</h1>

        <form action="{{ route('myblogs.storeDraft') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-white">Judul</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-white">Konten</label>
                <textarea id="content-editor" name="content" rows="6" class="w-full border-gray-300 rounded px-4 py-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-white">Kategori</label>
                <select name="category_id" class="w-full border-gray-300 rounded px-4 py-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-white">Gambar</label>
                <input type="file" name="image" class="w-full border-gray-300 rounded px-4 py-2">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Draft</button>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- Tambahkan script TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/ll3jubzwzn2402s9dzabf7sutbrnyaylc7470dlc88b9qgi6/tinymce/7/tinymce.min.js"
 referrerpolicy="origin"></script>
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
                content_style: 'body { font-family:Arial,sans-serif; font-size:14px }'
            });
        });
    </script>
@endsection
