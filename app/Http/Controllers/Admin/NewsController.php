<?php

// app/Http/Controllers/Admin/NewsController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    // List berita (admin)
    public function index()
    {
        $news = News::with('category')->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    // Form tambah berita
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.news.create', compact('categories', 'tags'));
    }

    // Simpan berita baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'tags' => 'array',
        ]);
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(4);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $news = News::create($data);

        // Attach tags jika ada
        if ($request->tags) {
            $news->tags()->sync($request->tags);
        }

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat!');
    }

    // Form edit berita
    public function edit(News $news)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $news->tags->pluck('id')->toArray();
        return view('admin.news.edit', compact('news', 'categories', 'tags', 'selectedTags'));
    }

    // Update berita
    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'tags' => 'array',
        ]);
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(4);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $news->update($data);

        if ($request->tags) {
            $news->tags()->sync($request->tags);
        } else {
            $news->tags()->detach();
        }

        return redirect()->route('news.index')->with('success', 'Berita berhasil diupdate!');
    }

    // Hapus berita
    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    }
}
