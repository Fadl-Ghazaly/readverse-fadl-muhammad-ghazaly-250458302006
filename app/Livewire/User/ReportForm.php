<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportForm extends Component
{
    public $targetType;
    public $targetId;

    public $kategori;
    public $deskripsi;

    protected $rules = [
        'kategori' => 'required|string|max:255',
        'deskripsi' => 'nullable|string'
    ];

    public function mount($targetType, $targetId)
    {
        $this->targetType = $targetType;
        $this->targetId = $targetId;
    }

    private function mapTargetType($type)
    {
        return match ($type) {
            'novel' => \App\Models\Novel::class,
            'episode' => \App\Models\Episode::class,
            default => null,
        };
    }

    public function submit()
    {
        $this->validate();

        Report::create([
            'user_id'     => Auth::id(),
            'target_type' => $this->mapTargetType($this->targetType),
            'target_id'   => $this->targetId,
            'kategori'    => $this->kategori,
            'deskripsi'   => $this->deskripsi,
            'status'      => 'Baru',
        ]);

        session()->flash('message', 'Laporan berhasil dikirim.');
        $this->reset(['kategori', 'deskripsi']);
    }

    public function render()
    {
        return view('livewire.user.report-form');
    }
}
