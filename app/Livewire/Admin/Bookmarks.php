<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Bookmark;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;

class Bookmarks extends Component
{
    public $bookmarks;
    public $novels;
    public $selectedNovel;

    public function mount()
    {
        // Ambil semua novel agar user bisa pilih yang ingin dibookmark
        $this->novels = Novel::all();
        $this->loadBookmarks();
    }

    public function loadBookmarks()
    {
        $this->bookmarks = Bookmark::where('user_id', Auth::id())
            ->with('novel')
            ->latest()
            ->get();
    }

    public function addBookmark()
    {
        if (!$this->selectedNovel) {
            session()->flash('error', 'Pilih novel terlebih dahulu.');
            return;
        }

        $exists = Bookmark::where('user_id', Auth::id())
            ->where('novel_id', $this->selectedNovel)
            ->exists();

        if ($exists) {
            session()->flash('error', 'Novel ini sudah ada di bookmark Anda.');
            return;
        }

        Bookmark::create([
            'user_id' => Auth::id(),
            'novel_id' => $this->selectedNovel,
        ]);

        session()->flash('message', 'Novel berhasil ditambahkan ke bookmark.');
        $this->selectedNovel = null;
        $this->loadBookmarks();
    }

    public function removeBookmark($id)
    {
        $bookmark = Bookmark::findOrFail($id);

        if ($bookmark->user_id === Auth::id()) {
            $bookmark->delete();
            session()->flash('message', 'Bookmark berhasil dihapus.');
            $this->loadBookmarks();
        }
    }

    public function render()
    {
        return view('livewire.admin.bookmarks');
    }
}
