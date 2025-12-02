<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Genre;
use App\Models\Novel;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Notification;

class Dashboard extends Component
{
    // === STATISTIK TOTAL ===
    public $totalNovels;
    public $totalEpisodes;
    public $totalGenres;
    public $totalUsers;

    // === RECENT DATA ===
    public $recentUsers;
    public $recentComments;
    public $recentReports;
    public $unreadNotifications;

    protected $listeners = ['episodeCreated' => 'loadRecentActivities'];

    public function mount()
    {
        // Statistik jumlah data
        $this->totalNovels = Novel::count();
        $this->totalEpisodes = Episode::count();
        $this->totalGenres = Genre::count();
        $this->totalUsers = User::count();

        // Aktivitas terbaru
        $this->loadRecentActivities();
    }

    public function loadRecentActivities()
    {
        $this->recentUsers = User::latest()->take(5)->get();
        $this->recentComments = Comment::with('user')->latest()->take(5)->get();
        $this->recentReports = Report::with('user')->latest()->take(5)->get();

        $this->unreadNotifications = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'chartData' => [
                'novels'   => $this->totalNovels,
                'episodes' => $this->totalEpisodes,
                'genres'   => $this->totalGenres,
                'users'    => $this->totalUsers,
            ],
            'totalNovels'        => $this->totalNovels,
            'totalEpisodes'      => $this->totalEpisodes,
            'totalGenres'        => $this->totalGenres,
            'totalUsers'         => $this->totalUsers,
            'recentUsers'        => $this->recentUsers,
            'recentComments'     => $this->recentComments,
            'recentReports'      => $this->recentReports,
            'unreadNotifications'=> $this->unreadNotifications,
        ])->layout('layouts.admin');
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id === auth()->id()) {
            $notification->update(['is_read' => true]);
            $this->loadRecentActivities();
        }
    }
}
