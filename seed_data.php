<?php

use App\Models\Genre;
use App\Models\Novel;
use App\Models\Episode;

// Create 10 genres
$genres = [];
for ($i = 1; $i <= 10; $i++) {
    $genres[] = Genre::create([
        'nama' => 'Genre ' . $i,
        'description' => 'Description for Genre ' . $i,
    ]);
}

// Create 10 novels
$novels = [];
for ($i = 1; $i <= 10; $i++) {
    $novel = Novel::create([
        'admin_id' => 1,
        'title' => 'Novel ' . $i,
        'description' => 'Description for Novel ' . $i,
        'cover_image' => 'covers/c5L4NqflHBgIB0jorvkxrCeVXL2wQFQh3GINI5Je.png',
        'file_path' => 'novel_files/4QMJ8poliLidnDIV25w0s1jAV4OZoH1wGjRl9ouG.pdf',
        'status' => 'aktif',
    ]);

    // Attach random genres to each novel
    $randomGenres = collect($genres)->random(rand(1, 3))->pluck('id');
    $novel->genres()->sync($randomGenres);

    $novels[] = $novel;
}

// Create 10 episodes for each novel
foreach ($novels as $novel) {
    for ($j = 1; $j <= 10; $j++) {
        Episode::create([
            'novel_id' => $novel->id,
            'title' => 'Episode ' . $j . ' of ' . $novel->title,
            'content' => 'Content for Episode ' . $j . ' of ' . $novel->title,
            'file_path' => 'episode_files/itBKCIUtY7uNq0QdlWRsd3WgAEZq2vNnIKdaGPIY.pdf',
            'episode_number' => $j,
            'status' => 'aktif',
        ]);
    }
}

echo 'Created ' . count($genres) . ' genres, ' . count($novels) . ' novels, and ' . (count($novels) * 10) . ' episodes.';
