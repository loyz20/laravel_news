<?php

// app/Http/Controllers/CommentController.php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $news_id)
    {
        $request->validate([
            'author' => 'required|max:50',
            'content' => 'required|max:500',
        ]);

        $news = News::findOrFail($news_id);

        $news->comments()->create([
            'author' => $request->author,
            'content' => $request->content,
            'approved' => false, // auto approve? ubah ke true jika ingin langsung tampil
        ]);

        return back()->with('success', 'Komentar sudah terkirim dan menunggu moderasi.');
    }
}
