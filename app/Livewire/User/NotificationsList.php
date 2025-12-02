<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Notification;

class NotificationsList extends Component
{
    use WithPagination;

    public function mount()
    {
        Notification::forUser(auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public function delete($id)
    {
        Notification::forUser(auth()->id())->where('id', $id)->delete();
    }

    public function deleteAll()
    {
        Notification::forUser(auth()->id())->delete();
    }

    public function render()
    {
        $notifications = Notification::forUser(auth()->id())
            ->orderBy('sent_at', 'desc')
            ->paginate(10);

        return view('livewire.user.notifications-list', compact('notifications'))
            ->layout('layouts.user');
    }
}
