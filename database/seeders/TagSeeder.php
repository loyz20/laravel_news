<?php

// database/seeders/TagSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Startup', 'slug' => 'startup'],
            ['name' => 'Viral', 'slug' => 'viral'],
            ['name' => 'Politik', 'slug' => 'politik'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi'],
        ];
        Tag::insert($tags);
    }
}
