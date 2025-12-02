<?php
namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Episode;

class ReadEpisode extends Component
{
    public $episode;

    public function mount($slug, $episodeNumber)
    {
        $this->episode = Episode::where('episode_number', $episodeNumber)
            ->whereHas('novel', fn($q) => $q->where('slug', $slug))
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.user.read-episode')
            ->layout('layouts.user');
    }
}
