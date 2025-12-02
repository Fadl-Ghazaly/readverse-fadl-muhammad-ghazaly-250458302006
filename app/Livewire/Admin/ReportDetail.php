<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Report;

class ReportDetail extends Component
{
    public $report;

    public function mount($reportId)
    {
        $this->report = Report::with('user', 'target')->findOrFail($reportId);
    }

    public function render()
    {
        return view('livewire.admin.report-detail')
            ->layout('layouts.admin');
    }
}
