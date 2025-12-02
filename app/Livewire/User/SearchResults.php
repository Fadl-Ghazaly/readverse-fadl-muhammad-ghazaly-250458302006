<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Novel;
use App\Models\Episode;

class SearchResults extends Component
{
    use WithPagination;

    public function render()
    {
        $query = request('q', '');
        $novels = collect();
        $episodes = collect();

        if ($query) {
            $keyword = "%{$query}%";
            $novels = Novel::where('status', 'active')
                ->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', $keyword)
                      ->orWhere('author', 'like', $keyword);
                })
                ->paginate(10);

            $episodes = Episode::where('status', 'publish')
                ->where('judul', 'like', $keyword)
                ->with('novel')
                ->paginate(10);
        }

        return view('livewire.user.search-results', compact('query', 'novels', 'episodes'))
            ->layout('layouts.user');
    }
}