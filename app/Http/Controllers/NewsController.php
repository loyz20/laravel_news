<?php

// app/Http/Controllers/NewsController.php
namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Homepage - list berita terbaru
    public function index()
    {
        $news = News::with(['category', 'tags', 'user'])
            ->latest()
            ->paginate(10);
            
        $hero = News::where('is_hero', true)->latest()->first()
            ?? News::latest()->first(); // fallback ke berita terbaru jika tidak ada yang is_hero

        // Berita lain, tag, kategori, dll
        $news = News::latest()->where('id', '!=', $hero?->id)->paginate(10);

        return view('frontend.home', compact('news', 'hero'));
    }

    // Halaman detail berita
    public function show($slug)
    {
        $news = News::with(['category', 'tags', 'user', 'comments'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Berita terkait (satu kategori, beda id)
        $related = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->latest()
            ->limit(4)
            ->get();

        // Naikkan counter views
        $news->increment('views');

        return view('frontend.news.show', compact('news', 'related'));
    }

    // List berita per kategori
    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $news = News::where('category_id', $category->id)
            ->latest()
            ->paginate(10);

        return view('frontend.category', compact('category', 'news'));
    }

    // Search berita
    public function search(Request $request) {
        $keyword = $request->keyword;
        $news = News::where('title', 'like', "%$keyword%")
            ->orWhere('content', 'like', "%$keyword%")
            ->latest()
            ->paginate(10);
        return view('frontend.search', compact('news', 'keyword'));
    }
}
