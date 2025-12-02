<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Genre::create([
                'nama' => 'Genre ' . $i,
                'deskripsi' => 'Deskripsi genre ' . $i,
            ]);
        }
    }
}
