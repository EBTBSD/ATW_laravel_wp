<?php

namespace App\Livewire\Dashboard;

use App\Models\Log;
use Livewire\Component;
use Livewire\WithPagination;

class StatusIndex extends Component
{
    use WithPagination;

    public $sortBy = 'domain';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public function sort(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function render()
    {
        $logs = Log::orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.dashboard.status-index')
            ->with(['logs' => $logs])
            ->layout('layouts.app');
    }
}
