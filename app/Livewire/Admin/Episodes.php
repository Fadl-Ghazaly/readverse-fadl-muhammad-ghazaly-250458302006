<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Episode;
use App\Models\Novel;

class Episodes extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $novels;

    public $episode_id;
    public $novel_id;
    public $judul;
    public $deskripsi;
    public $episode_number;
    public $cover_image;
    public $file_path;
    public $status = 'active';

    public $search = '';

    public function mount()
    {
        $this->novels = Novel::orderBy('title')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $episodes = Episode::where('judul', 'like', "%{$this->search}%")
            ->orWhere('deskripsi', 'like', "%{$this->search}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.episodes', compact('episodes'))
            ->layout('layouts.admin');
    }

    public function resetInput()
    {
        $this->episode_id = null;
        $this->novel_id = '';
        $this->judul = '';
        $this->deskripsi = '';
        $this->episode_number = '';
        $this->cover_image = null;
        $this->file_path = null;
        $this->status = 'active';
    }

    public function store()
    {
        $this->validate([
            'novel_id'        => 'required',
            'judul'           => 'required|string|max:255',
            'episode_number'  => 'required|integer',
            'deskripsi'       => 'nullable|string',
            'cover_image'     => 'nullable|image|max:2048',
            'file_path'       => 'nullable|mimes:pdf,doc,docx,epub,txt|max:51200',
            'status'          => 'required|in:active,inactive',
        ]);

        $coverPath = $this->cover_image
            ? $this->cover_image->store('episode_covers', 'public')
            : null;

        $filePath = $this->file_path
            ? $this->file_path->store('episode_files', 'public')
            : null;

        Episode::updateOrCreate(
            ['id' => $this->episode_id],
            [
                'novel_id'       => $this->novel_id,
                'judul'          => $this->judul,
                'deskripsi'      => $this->deskripsi,
                'episode_number' => $this->episode_number,
                'cover_image'    => $coverPath,
                'file_path'      => $filePath,
                'status'         => $this->status,
            ]
        );

        session()->flash('message', $this->episode_id ? 'Episode berhasil diperbarui.' : 'Episode berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $ep = Episode::findOrFail($id);

        $this->episode_id     = $ep->id;
        $this->novel_id       = $ep->novel_id;
        $this->judul          = $ep->judul;
        $this->deskripsi      = $ep->deskripsi;
        $this->episode_number = $ep->episode_number;
        $this->status         = $ep->status;
    }

    public function delete($id)
    {
        Episode::findOrFail($id)->delete();
        session()->flash('message', 'Episode berhasil dihapus.');
    }
}
