<?php

namespace App\Livewire\User;

use App\Models\Novel;
use Livewire\Component;
use Livewire\WithPagination;

class Homepage extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.user.homepage', [
            'novels' => Novel::where('status', 'active')
                ->latest()
                ->paginate(12),
        ])->layout('layouts.user');
    }
}
