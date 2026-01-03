<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Politik', 'description' => 'Berita seputar politik nasional dan internasional'],
            ['name' => 'Ekonomi', 'description' => 'Berita bisnis, keuangan, dan ekonomi'],
            ['name' => 'Olahraga', 'description' => 'Berita olahraga terkini'],
            ['name' => 'Teknologi', 'description' => 'Berita teknologi dan inovasi'],
            ['name' => 'Hiburan', 'description' => 'Berita entertainment dan selebriti'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
