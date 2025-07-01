<?php

// database/seeders/CategorySeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Nasional', 'slug' => 'nasional'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
            ['name' => 'Internasional', 'slug' => 'internasional'],
        ];
        Category::insert($data);
    }
}
