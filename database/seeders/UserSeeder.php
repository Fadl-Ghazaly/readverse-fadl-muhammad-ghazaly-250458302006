<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::updateOrCreate(
            ['email' => 'admin@readverse.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // User biasa default
        User::updateOrCreate(
            ['email' => 'user@readverse.com'],
            [
                'name' => 'User Biasa',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        );
    }
}
