<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Menampilkan semua artikel pengguna yang sedang login
    public function myArticles(Request $request)
    {
        $query = Article::query()->where('author_id', Auth::id());

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Pencarian berdasarkan judul atau konten
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting (default: terbaru)
        $sort = $request->get('sort', 'latest');
        $query->orderBy('created_at', $sort === 'latest' ? 'desc' : 'asc');

        $articles = $query->with('category')->paginate(10);
        $categories = Category::all();

        return view('articles.myarticles', compact('articles', 'categories'));
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($validated['title'], '-');
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('articles', 'public') : null;

        $article = Article::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'author_id' => Auth::id(),
            'status' => 'draft',
        ]);

        // Simpan Tags
        if (!empty($request->tags)) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $article->tags()->sync($tagIds);
        }

        return redirect()->route('myarticle')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Mengedit artikel
    public function edit($id)
    {
        $article = Article::where('id', $id)->where('author_id', Auth::id())->firstOrFail();
        $categories = Category::all();

        return view('articles.edit', compact('article', 'categories'));
    }

    // Memperbarui artikel
    public function update(Request $request, $id)
    {
        $article = Article::where('id', $id)->where('author_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // Proses upload gambar baru jika ada
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $article->image,
        ]);

        return redirect()->route('myarticle')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Menghapus artikel
    public function destroy($id)
    {
        $article = Article::where('id', $id)->where('author_id', Auth::id())->firstOrFail();

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('myarticle')->with('success', 'Artikel berhasil dihapus!');
    }

    // Mempublikasikan artikel
    public function publish($id)
    {
        $article = Article::where('id', $id)->where('author_id', Auth::id())->firstOrFail();

        if ($article->status === 'draft') {
            $article->status = 'published';
            $article->published_at = now();
            $article->save();
        }

        return redirect()->route('myarticle')->with('success', 'Artikel berhasil dipublikasikan!');
    }

    // Menampilkan semua artikel
    public function index(Request $request)
    {
        $query = Article::with(['tags', 'category']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', $request->tag);
            });
        }

        $articles = $query->where('status', 'published')->latest()->paginate(9);
        $categories = Category::all();
        $trendingTags = Tag::withCount('articles')->orderBy('articles_count', 'desc')->take(10)->get();

        return view('articles.index', compact('articles', 'categories', 'trendingTags'));
    }

    // Membuat artikel baru
    public function create()
    {
        $categories = Category::all();

        return view('articles.createarticle', compact('categories'));
    }

    // Beranda dengan artikel terbaru dan trending
    public function home()
    {
        $hotNews = Article::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $trendingTags = Tag::withCount('articles')->orderBy('articles_count', 'desc')->take(10)->get();
        $trendingTopics = Article::orderBy('views', 'desc')->take(5)->get();

        return view('home', compact('hotNews', 'trendingTags', 'trendingTopics'));
    }

    // Menampilkan artikel berdasarkan slug
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $article->increment('views');

        return view('articles.show', compact('article'));
    }
}
