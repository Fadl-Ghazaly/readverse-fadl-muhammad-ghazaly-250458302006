<?php

namespace App\Livewire\Admin;

use App\Models\Novel;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Genre;

class Novels extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // INPUT FIELDS
    public $title, $description, $cover_image, $author, $status = 'active';
    public $selectedGenres = [];

    // SEARCH
    public $search = '';

    // EDIT MODE
    public $isEdit = false;
    public $editId = null;
    public $old_cover;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $novels = Novel::with('genres')
            ->where('admin_id', auth()->id())
            ->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('author', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
                  ->orWhere('status', 'like', "%{$this->search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $allGenres = Genre::all();

        return view('livewire.admin.novels', compact('novels', 'allGenres'))
            ->layout('layouts.admin', ['title' => 'Kelola Novel']);
    }

    public function store()
    {
        $this->validate([
            'title'       => 'required|max:255',
            'author'      => 'nullable|string|max:255',
            'description' => 'nullable',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $coverPath = $this->cover_image
            ? $this->cover_image->store('covers', 'public')
            : null;

        $novel = Novel::create([
            'admin_id'    => auth()->id(),
            'title'       => $this->title,
            'slug'        => Str::slug($this->title),
            'author'      => $this->author,
            'description' => $this->description,
            'cover_image' => $coverPath,
            'status'      => $this->status,
        ]);

        // Simpan genre
        if (!empty($this->selectedGenres)) {
            $novel->genres()->attach($this->selectedGenres);
        }

        session()->flash('message', 'Novel berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $novel = Novel::with('genres')->findOrFail($id);

        $this->editId = $id;
        $this->title = $novel->title;
        $this->author = $novel->author;
        $this->description = $novel->description;
        $this->status = $novel->status;
        $this->old_cover = $novel->cover_image;
        $this->selectedGenres = $novel->genres->pluck('id')->toArray();

        $this->isEdit = true;
    }

    public function update()
    {
        $novel = Novel::findOrFail($this->editId);

        $this->validate([
            'title'       => 'required|max:255',
            'author'      => 'nullable|string|max:255',
            'description' => 'nullable',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $coverPath = $this->cover_image
            ? $this->cover_image->store('covers', 'public')
            : $this->old_cover;

        $novel->update([
            'title'       => $this->title,
            'author'      => $this->author,
            'description' => $this->description,
            'status'      => $this->status,
            'cover_image' => $coverPath,
        ]);

        // Update genre
        $novel->genres()->sync($this->selectedGenres ?? []);

        session()->flash('message', 'Novel berhasil diperbarui.');
        $this->resetInput();
        $this->isEdit = false;
    }

    public function delete($id)
    {
        Novel::findOrFail($id)->delete();
        session()->flash('message', 'Novel berhasil dihapus.');
        $this->resetPage();
    }

    public function resetInput()
    {
        $this->title = '';
        $this->description = '';
        $this->author = '';
        $this->cover_image = null;
        $this->status = 'active';
        $this->editId = null;
        $this->old_cover = null;
        $this->selectedGenres = [];
        $this->isEdit = false;
    }
}
