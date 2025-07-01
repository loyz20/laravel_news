<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [NewsController::class, 'index'])->name('home');

// Detail berita
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// List berita per kategori
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

// List berita per tag (optional)
Route::get('/tag/{slug}', [TagController::class, 'show'])->name('tag.show');

// Search berita
Route::get('/search', [NewsController::class, 'search'])->name('news.search');

// Komentar (post komentar ke berita)
Route::post('/news/{news}/comment', [NewsController::class, 'comment'])->name('news.comment');

// Static pages
Route::view('/about', 'frontend.about')->name('about');
Route::view('/contact', 'frontend.contact')->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
