<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GenreSeeder;
use Database\Seeders\NovelSeeder;
use Database\Seeders\ReportSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\EpisodeSeeder;
use Database\Seeders\BookmarkSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GenreSeeder::class,
            NovelSeeder::class,
            EpisodeSeeder::class,
            BookmarkSeeder::class,
            CommentSeeder::class,
            ReportSeeder::class,
        ]);
    }
}
