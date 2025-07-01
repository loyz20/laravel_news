<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('categories')) {
            View::share('categories', \App\Models\Category::orderBy('name')->get());
        }
        if (Schema::hasTable('tags')) {
            View::share('tags', \App\Models\Tag::withCount('news')->orderByDesc('news_count')->take(10)->get());
        }
    }
}
