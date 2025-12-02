<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Novel;

class Comments extends Component
{
    public function render()
    {
        // Daftar novel yang memiliki komentar
        $novels = Novel::withCount('comments')
            ->has('comments')
            ->orderBy('comments_count', 'desc')
            ->get();

        return view('livewire.admin.comments', [
            'novels' => $novels
        ])->layout('layouts.admin', [
            'title' => 'Kelola Komentar'
        ]);
    }
}
