<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Novel;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $novels = Novel::all();

        foreach ($novels as $novel) {
            $totalComments = rand(2, 5);

            for ($i = 0; $i < $totalComments; $i++) {
                Comment::create([
                    'user_id' => $users->random()->id,
                    'novel_id' => $novel->id,
                    'comment' => fake()->sentence(rand(5, 12)),
                ]);
            }
        }
    }
}
