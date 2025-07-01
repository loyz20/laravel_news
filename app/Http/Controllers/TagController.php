<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Tampilkan berita berdasarkan tag
     */
    public function show($slug)
    {
        // Ambil tag berdasarkan slug
        $tag = Tag::where('slug', $slug)->firstOrFail();

        // Berita yang punya tag ini, paginasi
        $news = $tag->news()->with(['category', 'user'])->latest()->paginate(10);

        return view('frontend.tag.show', compact('tag', 'news'));
    }
}
