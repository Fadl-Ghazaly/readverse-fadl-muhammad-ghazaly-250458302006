<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Novel;
use App\Models\Genre;
use App\Models\Episode;
use App\Models\User;
use App\Models\Comment;
use App\Models\Report;

class GlobalSearch extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = [];

        if (trim($this->query) === '') return;

        $keyword = '%' . $this->query . '%';

        $this->results = [
            'novels' => Novel::where('status', 'active')
                ->where(fn($q) => $q->where('title', 'like', $keyword)
                                    ->orWhere('author', 'like', $keyword))
                ->limit(5)->get(),

            'episodes' => Episode::where('status', 'publish')
                ->where('judul', 'like', $keyword)
                ->with('novel')
                ->limit(5)->get(),

            'genres' => Genre::where('nama', 'like', $keyword)
                ->limit(5)->get(),

            'users' => User::where('name', 'like', $keyword)
                ->orWhere('email', 'like', $keyword)
                ->limit(5)->get(),

            'comments' => Comment::where('comment', 'like', $keyword)
                ->with('user')
                ->limit(5)->get(),

            'reports' => Report::where('deskripsi', 'like', $keyword)
                ->limit(5)->get(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.global-search');
    }
}
