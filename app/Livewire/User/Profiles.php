<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Profiles extends Component
{
    use WithFileUploads;

    public $name, $email, $password, $new_password, $profile_photo;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->profile_photo = auth()->user()->profile_photo;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();

        // Upload foto jika ada
        if ($this->profile_photo && !is_string($this->profile_photo)) {
            $path = $this->profile_photo->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        // Update nama & email
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        session()->flash('message', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->password, $user->password)) {
            session()->flash('error', 'Password lama salah.');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('message', 'Password berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.user.profiles')->layout('layouts.user');
    }
}
