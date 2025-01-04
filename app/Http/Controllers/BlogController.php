<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category');
        $query = Blog::with(['category', 'author'])->latest();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $blogs = $query->paginate(5);
        $recommendedBlogs = Blog::inRandomOrder()->limit(3)->get();
        $categories = Category::all();

        return view('blogs.index', compact('blogs', 'categories', 'recommendedBlogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'author_id' => Auth::id(),
            'status' => 'draft',
            'published_at' => null, 
        ]);


        return redirect()->route('blogs.index')->with('success', 'Blog berhasil disimpan!');
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        $blog->increment('views');
        return view('blogs.show', compact('blog'));
    }

    public function destroy($id)
    {
       
        $blog = Blog::where('id', $id)->where('author_id', Auth::id())->firstOrFail();

        
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

    
        $blog->delete();

        return redirect()->route('myblogs')->with('success', 'Blog berhasil dihapus!');
    }
    public function myBlogs()
    {
        $blogs = Blog::where('author_id', Auth::id())->with('category')->paginate(6);

        return view('blogs.myblogs', compact('blogs'));
    }

    public function publish($id)
    {
        $blog = Blog::where('id', $id)->where('author_id', Auth::id())->firstOrFail();

        if ($blog->status === 'draft') {
            $blog->update([
                'status' => 'published',
                'published_at' => now(),
            ]);
        }

        return redirect()->route('myblogs')->with('success', 'Blog berhasil dipublikasikan!');
    }

    public function edit($id)
    {
        $blog = Blog::where('id', $id)->where('author_id', Auth::id())->firstOrFail();
        $categories = Category::all();

        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $blog = Blog::findOrFail($id);


        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image); 
            }
            $blog->image = $request->file('image')->store('blogs', 'public'); 
        }

        $blog->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $blog->image,
        ]);

        return redirect()->route('myblogs')->with('success', 'Blog berhasil diperbarui!');
    }

    public function storeDraft(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('drafts', 'public');
        }

        Blog::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'author_id' => Auth::id(),
            'status' => 'draft',
        ]);

        return redirect()->route('myblogs')->with('success', 'Draft berhasil disimpan.');
    }

    public function publishDraft(Request $request)
    {

        $blog = Blog::where('id', $request->id)
            ->where('status', 'draft')
            ->where('author_id', Auth::id())
            ->firstOrFail();

        $blog->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()->route('myblogs')->with('success', 'Blog berhasil dipublikasikan.');
    }
}
