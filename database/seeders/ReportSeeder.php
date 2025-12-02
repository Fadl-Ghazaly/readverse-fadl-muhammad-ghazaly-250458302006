<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Novel;
use App\Models\Episode;
use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $novels = Novel::all();
        $episodes = Episode::all();

        $kategori = [
            'Pelanggaran Aturan',
            'Konten Tidak Pantas',
            'Spam',
            'Lainnya'
        ];

        foreach ($users as $user) {

           
            foreach ($novels->random(min(2, $novels->count())) as $novel) {
                Report::create([
                    'user_id' => $user->id,
                    'target_type' => \App\Models\Novel::class,
                    'target_id' => $novel->id,
                    'kategori' => $kategori[array_rand($kategori)],
                    'deskripsi' => "Dummy laporan pada novel: {$novel->title}",
                    'status' => 'Baru',
                ]);
            }

            
            foreach ($episodes->random(min(2, $episodes->count())) as $ep) {
                Report::create([
                    'user_id' => $user->id,
                    'target_type' => \App\Models\Episode::class,
                    'target_id' => $ep->id,
                    'kategori' => $kategori[array_rand($kategori)],
                    'deskripsi' => "Dummy laporan pada episode: {$ep->judul}",
                    'status' => 'Baru',
                ]);
            }
        }
    }
}
