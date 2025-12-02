<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Novel;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Comment;
use App\Models\User;

class SearchResult extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = request('q', '');

        // Inisialisasi sebagai koleksi kosong
        $novels = collect();
        $episodes = collect();
        $genres = collect();
        $comments = collect();
        $users = collect();

        if ($query) {
            $keyword = "%{$query}%";

            $novels = Novel::where('status', 'active')
                ->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', $keyword)
                      ->orWhere('author', 'like', $keyword);
                })
                ->paginate(5);

            $episodes = Episode::where('status', 'publish')
                ->where('judul', 'like', $keyword)
                ->with('novel')
                ->paginate(5);

            $genres = Genre::where('nama', 'like', $keyword)
                ->paginate(5);

            $comments = Comment::where('comment', 'like', $keyword)
                ->with('user', 'novel')
                ->paginate(5);

            $users = User::where('name', 'like', $keyword)
                ->orWhere('email', 'like', $keyword)
                ->paginate(5);
        }

        return view('livewire.admin.search-result', compact(
            'query', 'novels', 'episodes', 'genres', 'comments', 'users'
        ))->layout('layouts.admin');
    }
}