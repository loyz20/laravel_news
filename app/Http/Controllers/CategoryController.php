<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Tampilkan berita berdasarkan kategori
     */
    public function show($slug)
    {
        // Ambil kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Ambil berita dengan kategori ini
        $news = $category->news()->with(['tags', 'user'])->latest()->paginate(10);

        return view('frontend.category.show', compact('category', 'news'));
    }
}
