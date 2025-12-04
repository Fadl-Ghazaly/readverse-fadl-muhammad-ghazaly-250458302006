<?php

namespace App\Livewire\User;

use App\Models\Novel;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Novels extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.user.novels', [
            'novels' => Novel::where('status', 'active')
                ->orderBy('title', 'asc') 
                ->paginate(12)
        ])->layout('layouts.user');
    }
}
