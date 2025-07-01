<?php

// database/seeders/CommentSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\News;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $news = News::all();

        foreach ($news as $item) {
            $totalComments = rand(1, 5);
            for ($i = 0; $i < $totalComments; $i++) {
                Comment::create([
                    'news_id'  => $item->id,
                    'author'   => $faker->name,
                    'content'  => $faker->sentence(rand(8, 15)),
                    'approved' => $faker->boolean(90),
                ]);
            }
        }
    }
}
