<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Notification;

class SendNotification extends Component
{
    public $user_id = 'all'; 
    public $type = 'system';
    public $message = '';

    public function send()
    {
        $this->validate([
            'type' => 'required|string',
            'message' => 'required|string|max:255',
            'user_id' => 'required',
        ]);

        if ($this->user_id === 'all') {

            // Kirim notifikasi global ke user yang notifnya aktif
            $users = User::where('notifications_enabled', true)->get();

            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'type' => $this->type,
                    'message' => $this->message,
                    'sent_at' => now(),
                ]);
            }

        } else {

            // Kirim ke user tertentu
            Notification::create([
                'user_id' => $this->user_id,
                'type' => $this->type,
                'message' => $this->message,
                'sent_at' => now(),
            ]);
        }

        $this->reset(['user_id', 'type', 'message']);

        session()->flash('success', 'Notifikasi berhasil dikirim!');
    }

    public function render()
    {
        $users = User::all();

        return view('livewire.admin.send-notification', compact('users'))
            ->layout('layouts.admin', [
                'title' => 'Kelola Notifikasi'
            ]);
    }
}
