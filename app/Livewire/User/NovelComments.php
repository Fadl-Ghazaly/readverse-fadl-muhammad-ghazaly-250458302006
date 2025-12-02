<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

class NovelComments extends Component
{
    use WithPagination;

    public $novel;
    public $commentText = '';
    public $replyTo = null;
    public $showReportForm = null;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'commentText' => 'required|string|max:1000',
    ];

    public function mount($novel)
    {
        $this->novel = $novel;
    }

    public function setReply($commentId)
    {
        $this->replyTo = Comment::findOrFail($commentId);
        $this->commentText = '';
    }

    public function cancelReply()
    {
        $this->replyTo = null;
        $this->commentText = '';
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'user_id' => Auth::id(),
            'novel_id' => $this->novel->id,
            'parent_id' => $this->replyTo?->id,
            'comment' => $this->commentText,
            'episode_id' => null,
        ]);

        $this->reset(['commentText', 'replyTo']);
        $this->dispatch('comment-added');
    }

    public function toggleLike($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $like = $comment->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            CommentLike::create([
                'comment_id' => $commentId,
                'user_id' => Auth::id(),
                'type' => 'like',
            ]);
        }
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // Hanya admin atau pemilik komentar yang bisa hapus
        if (Auth::user()->role === 'admin' || $comment->user_id === Auth::id()) {
            $comment->replies()->delete(); // Hapus balasan
            $comment->delete();
            $this->dispatch('comment-deleted');
        }
    }

    public function openReport($commentId)
    {
        $this->showReportForm = $commentId;
    }

    public function closeReport()
    {
        $this->showReportForm = null;
    }

    public function render()
    {
        $comments = Comment::where('novel_id', $this->novel->id)
            ->whereNull('parent_id')
            ->with([
                'user',
                'replies.user',
                'likes' => fn($q) => $q->where('user_id', Auth::id())
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.user.novel-comments', compact('comments'));
    }
}