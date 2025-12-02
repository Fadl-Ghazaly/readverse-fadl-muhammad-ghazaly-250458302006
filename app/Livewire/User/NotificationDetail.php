<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Notification;

class NotificationDetail extends Component
{
    public $notification;

    public function mount($id)
    {
        $this->notification = Notification::forUser(auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $this->notification->update(['is_read' => true]);
    }

    public function delete()
    {
        $this->notification->delete();
        return redirect()->route('user.notifications');
    }

    public function render()
    {
        return view('livewire.user.notification-detail')
            ->layout('layouts.user');
    }
}
