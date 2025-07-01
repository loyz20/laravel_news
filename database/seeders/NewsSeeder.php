<?php

// database/seeders/NewsSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        $categoryIds = \App\Models\Category::pluck('id')->toArray();
        $userIds = \App\Models\User::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            $title = $faker->sentence(rand(3, 8));
            News::create([
                'title'       => $title,
                'slug'        => Str::slug($title) . '-' . Str::random(4),
                'category_id' => $faker->randomElement($categoryIds),
                'user_id'     => $faker->randomElement($userIds),
                'content'     => '<p>' . $faker->paragraphs(rand(3, 8), true) . '</p>',
                'image'       => 'https://picsum.photos/600/400?random=' . rand(1,1000),
                'views'       => $faker->numberBetween(0, 100),
                'published'   => true,
            ]);
        }
    }
}
