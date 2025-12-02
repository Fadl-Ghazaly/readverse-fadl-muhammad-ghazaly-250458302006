<?php

namespace App\Livewire\Admin;

use App\Models\Episode;
use Livewire\Component;
use App\Models\NovelPage;
use Livewire\WithFileUploads;
use App\Livewire\Admin\NovelPages;

class NovelPages extends Component
{
    use WithFileUploads;

    public $episodes, $episode_id, $page_number, $caption, $image, $file, $status = 'active';
    public $novelPages, $novelPage_id;

    public function mount()
    {
        $this->episodes = Episode::all(); // admin bisa pilih Episode
    }

    public function render()
    {
        $this->novelPages = NovelPage::with('episode')->get();
        return view('livewire.admin.novel-pages');
    }

    public function resetInput()
    {
        $this->episode_id = '';
        $this->page_number = '';
        $this->caption = '';
        $this->image = '';
        $this->file = '';
        $this->status = 'active';
        $this->novelPage_id = null;
    }

    public function store()
    {
        $this->validate([
            'episode_id' => 'required|exists:episodes,id',
            'page_number' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx,epub,txt|max:51200',
        ]);

        $imagePath = $this->image ? $this->image->store('novel_pages_images', 'public') : null;
        $filePath = $this->file ? $this->file->store('novel_pages_files', 'public') : null;

        NovelPage::updateOrCreate(
            ['id' => $this->novelPage_id],
            [
                'episode_id' => $this->episode_id,
                'page_number' => $this->page_number,
                'caption' => $this->caption,
                'image_path' => $imagePath,
                'file_path' => $filePath,
                'status' => $this->status,
            ]
        );

        session()->flash('message', $this->novelPage_id ? 'Page updated.' : 'Page created.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $page = NovelPage::findOrFail($id);
        $this->novelPage_id = $page->id;
        $this->episode_id = $page->episode_id;
        $this->page_number = $page->page_number;
        $this->caption = $page->caption;
        $this->status = $page->status;
    }

    public function delete($id)
    {
        NovelPage::findOrFail($id)->delete();
        session()->flash('message', 'Page deleted.');
    }
}
