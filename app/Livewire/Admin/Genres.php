<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Genre;

class Genres extends Component
{
    public $genres;
    public $nama;
    public $genre_id;

    public function render()
    {
        $this->genres = Genre::all();

        return view('livewire.admin.genres')
            ->layout('layouts.admin', ['title' => 'Kelola Genre']);
    }

    public function resetInput()
    {
        $this->nama = '';
        $this->genre_id = null;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
        ]);

        Genre::updateOrCreate(
            ['id' => $this->genre_id],
            ['nama' => $this->nama]
        );

        session()->flash(
            'message',
            $this->genre_id ? 'Genre updated.' : 'Genre created.'
        );

        $this->resetInput();
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);

        $this->genre_id = $genre->id;
        $this->nama = $genre->nama;
    }

    public function delete($id)
    {
        Genre::findOrFail($id)->delete();
        session()->flash('message', 'Genre deleted.');
    }

    public function cancelEdit()
    {
        $this->reset(['nama', 'genre_id']);
    }
}
