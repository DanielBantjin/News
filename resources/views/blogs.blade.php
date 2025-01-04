@extends('layouts.app')

@section('title', 'Winnicode Garuda Teknologi')

@section('content')
<main class="container mx-auto px-4 py-20" x-data="blogPage({{ json_encode($blogs) }})">
    <div class="flex flex-wrap space-y-8 lg:flex-nowrap lg:space-y-0 lg:space-x-8">
        <!-- Kolom Utama Blog -->
        <div class="w-full lg:w-2/3">
            <h1 class="text-3xl font-bold mb-6" style="color: var(--text-primary);">Blog Terbaru</h1>
            <div class="space-y-6">
                <template x-for="blog in filteredBlogs" :key="blog.id">
                    <div class="rounded-lg shadow-md overflow-hidden flex flex-col lg:flex-row" 
                         style="background-color: var(--background-secondary); color: var(--text-primary);">
                        <!-- Gambar Blog -->
                        <img :src="blog.image || '/img/placeholder.png'" 
                             :alt="blog.title" 
                             class="w-full lg:w-48 h-36 object-cover">
                        <div class="p-4 flex flex-col justify-between flex-grow">
                            <div>
                                <span class="text-xs px-2 py-1 rounded-full mb-2 inline-block" 
                                      style="background-color: var(--button-primary); color: var(--button-text);"
                                      x-text="blog.category?.name || 'Tanpa Kategori'"></span>
                                <h2 class="text-xl font-semibold mb-2" x-text="blog.title"></h2>
                                <p class="text-sm mb-2 truncate" style="color: var(--text-secondary);" 
                                   x-text="blog.content.substring(0, 100) + '...'"></p>
                            </div>
                            <div class="flex justify-between items-center text-sm" style="color: var(--text-secondary);">
                                <span x-text="(blog.author?.name || 'Penulis Tidak Diketahui') + ' - ' + (new Date(blog.published_at).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }))"></span>
                                <a :href="'/blog/' + blog.slug" 
                                   class="flex items-center"
                                   style="color: var(--text-link);">
                                    Baca Selengkapnya
                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Sidebar Kanan -->
        <div class="w-full lg:w-1/3">
            <div class="mb-8">
                <h3 class="text-xl font-bold mb-4 flex items-center" style="color: var(--text-primary);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1h-5l-2 4h7a1 1 0 011 1v2a1 1 0 01-1 1h-7l2 4H7l2-4H4a1 1 0 01-1-1v-2a1 1 0 011-1h7L9 7H4a1 1 0 01-1-1V4z" />
                    </svg>
                    Filter Kategori
                </h3>
                <!-- Filter Kategori -->
                <form action="{{ route('articles.index') }}" method="GET" class="flex items-center space-x-4">
                    <select name="category" id="category" class="w-full rounded px-4 py-2" style="background-color: var(--background-secondary); color: var(--text-primary);">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-4 py-2 rounded hover:shadow-md"
                            style="background-color: var(--button-primary); color: var(--button-text);">
                        Filter
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    function blogPage(blogs) {
        return {
            selectedCategory: 'Semua Kategori',
            categories: ['Semua', ...new Set(blogs.map(blog => blog.category?.name || 'Tanpa Kategori'))],
            blogs: blogs,
            filterByCategory(category) {
                this.selectedCategory = category;
            },
            get filteredBlogs() {
                return this.selectedCategory === 'Semua Kategori'
                    ? this.blogs
                    : this.blogs.filter(blog => (blog.category?.name || 'Tanpa Kategori') === this.selectedCategory);
            },
        };
    }
</script>
@endsection
