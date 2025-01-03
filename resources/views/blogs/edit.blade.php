@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
    <div class="container mx-auto px-4 py-20">
        <h1 class="text-3xl font-bold text-white mb-8">Edit Blog</h1>

        <form action="{{ route('myblogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-white">Judul</label>
                <input type="text" name="title" value="{{ $blog->title }}" class="w-full border-gray-300 rounded px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-white">Konten</label>
                <textarea id="content-editor" name="content" rows="6" class="w-full border-gray-300 rounded px-4 py-2">
                    {{ $blog->content }}
                </textarea>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-white">Kategori</label>
                <select name="category_id" class="w-full border-gray-300 rounded px-4 py-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-white">Gambar</label>
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="mb-2 w-48">
                @endif
                <input type="file" name="image" class="w-full border-gray-300 rounded px-4 py-2">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
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
     branding: false // Hapus branding TinyMCE
 });
</script>
@endsection
