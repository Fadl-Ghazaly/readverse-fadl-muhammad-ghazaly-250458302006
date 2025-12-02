<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Notification;

class NotificationsDropdown extends Component
{
    public function render()
    {
        $recent = Notification::forUser(auth()->id())
            ->orderBy('sent_at', 'desc')
            ->limit(5)
            ->get();

        $unreadCount = Notification::forUser(auth()->id())
            ->where('is_read', false)
            ->count();

        return view('livewire.user.notifications-dropdown', compact('recent', 'unreadCount'));
    }
}
