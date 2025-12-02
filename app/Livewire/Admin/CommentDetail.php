<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;
use App\Models\Novel;
use Illuminate\Support\Facades\Auth;

class CommentDetail extends Component
{
    use WithPagination;

    public $novel;
    public $commentText = "";
    public $replyTo = null;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'commentText' => 'required|string|max:1000'
    ];

    public function mount($novelId)
    {
        $this->novel = Novel::findOrFail($novelId);
    }

    public function setReply($commentId)
    {
        $this->replyTo = Comment::findOrFail($commentId);
    }

    public function cancelReply()
    {
        $this->replyTo = null;
        $this->commentText = "";
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'user_id'   => Auth::id(),
            'novel_id'  => $this->novel->id,
            'parent_id' => $this->replyTo?->id,
            'comment'   => $this->commentText,
            'episode_id' => null,
        ]);

        $this->reset(['commentText', 'replyTo']);
        session()->flash('message', 'Komentar berhasil ditambahkan.');
    }

    public function delete($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $comment->delete();

        session()->flash('message', 'Komentar berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.comment-detail', [
            'comments' => Comment::where('novel_id', $this->novel->id)
                ->whereNull('parent_id')
                ->with(['replies.user', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ])->layout('layouts.admin', [
            'title' => "Komentar: {$this->novel->title}"
        ]);
    }
}
