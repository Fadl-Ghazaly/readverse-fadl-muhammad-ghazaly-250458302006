<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Novel;
use App\Models\Episode;

class EpisodeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Novel::all() as $novel) {
            for ($i = 1; $i <= 10; $i++) {
                Episode::create([
                    'novel_id' => $novel->id,
                    'judul' => 'Episode ' . $i . ' - ' . $novel->title,
                    'deskripsi' => 'Isi episode ' . $i,
                    'episode_number' => $i,
                    'cover_image' => null,
                    'file_path' => null,
                    'status' => 'active', 
                ]);
            }
        }
    }
}
