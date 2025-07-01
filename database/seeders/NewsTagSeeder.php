<?php

// database/seeders/NewsTagSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Tag;

class NewsTagSeeder extends Seeder
{
    public function run(): void
    {
        $tagIds = Tag::pluck('id')->toArray();
        $faker = \Faker\Factory::create();

        foreach (News::all() as $news) {
            // Ambil 1-3 tag acak untuk setiap news
            $randomTagIds = $faker->randomElements($tagIds, rand(1, 3));
            $news->tags()->sync($randomTagIds);
        }
    }
}
