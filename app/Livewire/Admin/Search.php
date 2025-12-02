<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Novel;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Comment;
use App\Models\User;

class Search extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = [];

        if (trim($this->query) === '') return;

        $keyword = '%' . $this->query . '%';

        $this->results = [
            'novels'   => Novel::where('title', 'like', $keyword)->limit(3)->get(),
            'episodes' => Episode::where('judul', 'like', $keyword)->with('novel')->limit(3)->get(),
            'genres'   => Genre::where('nama', 'like', $keyword)->limit(3)->get(),
            'comments' => Comment::where('comment', 'like', $keyword)->with('user')->limit(3)->get(),
            'users'    => User::where('name', 'like', $keyword)->limit(3)->get(),
        ];
    }

    public function redirectToResults()
    {
        return redirect()->route('admin.search-result', ['q' => $this->query]);
    }

    public function render()
    {
        return view('livewire.admin.search')
               ->layout('layouts.admin', ['title' => 'Hasil Pencarian']);
    }
}
