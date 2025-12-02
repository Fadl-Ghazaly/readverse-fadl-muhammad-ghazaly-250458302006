<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Novel;
use App\Models\Episode;
use App\Models\Bookmark;
use App\Models\Like;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class NovelDetail extends Component
{
    public $novel;
    public $isBookmarked = false;

    // === LIKE ===
    public $isLiked = false;
    public $likeCount = 0;

    // === RATING ===
    public $userRating = 0;
    public $showRatingForm = false;
    public $averageRating = 0;
    public $totalRatings = 0;

    public function mount($slug)
    {
        $this->novel = Novel::where('slug', $slug)
            ->where('status', 'active')
            ->withCount(['likes', 'ratings'])
            ->firstOrFail();

        // Bookmark
        $this->isBookmarked = Bookmark::where('user_id', Auth::id())
            ->where('novel_id', $this->novel->id)
            ->exists();

        // Like
        $this->isLiked = Like::where('user_id', Auth::id())
            ->where('likeable_type', 'App\Models\Novel')
            ->where('likeable_id', $this->novel->id)
            ->exists();
        $this->likeCount = $this->novel->likes_count;

        // Rating
        $ratingRecord = Rating::where('user_id', Auth::id())
            ->where('novel_id', $this->novel->id)
            ->first();
        $this->userRating = $ratingRecord ? $ratingRecord->rating : 0;

        $this->totalRatings = $this->novel->ratings_count;
        $this->averageRating = $this->totalRatings > 0
            ? round($this->novel->ratings()->avg('rating'), 1)
            : 0;
    }

    public function toggleBookmark()
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('novel_id', $this->novel->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $this->isBookmarked = false;
            session()->flash('bookmarkMessage', 'Bookmark dihapus.');
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'novel_id' => $this->novel->id,
            ]);
            $this->isBookmarked = true;
            session()->flash('bookmarkMessage', 'Bookmark ditambahkan.');
        }
    }

    public function toggleLike()
    {
        if (!Auth::check()) return;

        $like = Like::where('user_id', Auth::id())
            ->where('likeable_type', 'App\Models\Novel')
            ->where('likeable_id', $this->novel->id)
            ->first();

        if ($like) {
            $like->delete();
            $this->isLiked = false;
            $this->likeCount--;
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'likeable_type' => 'App\Models\Novel',
                'likeable_id' => $this->novel->id,
            ]);
            $this->isLiked = true;
            $this->likeCount++;
        }
    }

    public function showRatingForm()
    {
        $this->showRatingForm = true;
    }

    public function submitRating($rating)
    {
        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'novel_id' => $this->novel->id,
            ],
            ['rating' => $rating]
        );

        $this->userRating = $rating;
        $this->showRatingForm = false;

        // Refresh
        $this->totalRatings = $this->novel->ratings()->count();
        $this->averageRating = $this->totalRatings > 0
            ? round($this->novel->ratings()->avg('rating'), 1)
            : 0;
    }

    public function render()
    {
        return view('livewire.user.novel-detail', [
            'episodes' => Episode::where('novel_id', $this->novel->id)
                ->orderBy('episode_number', 'asc')
                ->get(),
        ])->layout('layouts.user');
    }
}