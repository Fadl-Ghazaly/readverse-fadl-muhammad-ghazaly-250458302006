<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Novel;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class Bookmarks extends Component
{
    use WithPagination;

    public $selectedNovel;

    public function mount()
    {
        $this->selectedNovel = null;
    }

    public function addBookmark()
    {
        $this->validate([
            'selectedNovel' => 'required|exists:novels,id'
        ]);

        $exists = Bookmark::where('user_id', Auth::id())
            ->where('novel_id', $this->selectedNovel)
            ->exists();

        if ($exists) {
            $this->dispatch('error', message: 'Novel ini sudah ada di bookmark Anda.');
            return;
        }

        Bookmark::create([
            'user_id' => Auth::id(),
            'novel_id' => $this->selectedNovel,
        ]);

        $this->selectedNovel = null;
        $this->dispatch('success', message: 'Novel berhasil ditambahkan ke bookmark.');
    }

    public function removeBookmark($id)
    {
        $bookmark = Bookmark::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $this->dispatch('success', message: 'Bookmark berhasil dihapus.');
        }
    }

    public function render()
    {
        $novels = Novel::all();

        return view('livewire.user.bookmarks', [
            'novels' => $novels,
            'bookmarks' => Bookmark::with('novel')
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(9),
        ])->layout('layouts.user');
    }
}
