<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Novel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class NovelSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $novel = Novel::create([
                'admin_id' => 1,
                'title' => 'Novel ' . $i,
                'slug' => Str::slug('Novel ' . $i),
                'description' => 'Deskripsi Novel ' . $i,
                'cover_image' => null,
                'author'     => "Penulis $i",                'status' => 'active', 
            ]);

            $novel->genres()->sync(
                Genre::inRandomOrder()->limit(rand(1, 3))->pluck('id')
            );
        }
    }
}
