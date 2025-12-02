<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Novel;
use App\Models\Bookmark;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $novels = Novel::all();

        foreach ($users as $user) {
            $randomNovels = $novels->random(min(3, $novels->count()));

            foreach ($randomNovels as $novel) {
                Bookmark::updateOrCreate([
                    'user_id' => $user->id,
                    'novel_id' => $novel->id,
                ]);
            }
        }
    }
}
