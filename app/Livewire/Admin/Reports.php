<?php

namespace App\Livewire\Admin;

use App\Models\Report;
use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Reports extends Component
{
    public $reports;
    public $reason, $target_type, $target_id;
    public $status = 'Pending';
    public $selectedReportId;

    protected $rules = [
        'reason' => 'required|string|max:1000',
    ];

    public function mount()
    {
        $this->loadReports();
    }

    public function loadReports()
    {
        $this->reports = Report::with('user')->latest()->get();
    }

    // 📌 User membuat laporan
    public function store()
    {
        $this->validate();

        $report = Report::create([
            'user_id' => Auth::id(),
            'target_type' => $this->target_type,
            'target_id' => $this->target_id,
            'kategori' => $this->reason,
            'deskripsi' => $this->reason,
        ]);

        // 🔔 Kirim notifikasi untuk admin
        $adminUsers = User::where('role', 'admin')->get();

        foreach ($adminUsers as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'report',
                'message' => 'Laporan baru dari ' . Auth::user()->name . ' terhadap '
                    . ucfirst($report->target_type) . ' #' . $report->target_id,
            ]);
        }

        $this->reset(['reason']);
        session()->flash('message', 'Laporan berhasil dikirim.');

        $this->loadReports();
    }

    // 📌 Admin memperbarui status
    public function updateStatus($id, $status)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => $status]);

        $this->loadReports();
        session()->flash('message', 'Status laporan diperbarui.');
    }

    // 📌 Admin menghapus laporan
    public function delete($id)
    {
        Report::findOrFail($id)->delete();

        $this->loadReports();
        session()->flash('message', 'Laporan dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.reports')
            ->layout('layouts.admin', ['title' => 'Kelola Laporan']);
    }
}
