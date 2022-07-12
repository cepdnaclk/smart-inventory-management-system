<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\JobRequests;

class FabricationsWaitingForSupervisorApprovalTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable()
                ->searchable(),
            Column::make("Machine", "machine")
                ->sortable(),
            Column::make("Material", "material")
                ->sortable(),
            Column::make("Student", "student")
                ->sortable(),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return JobRequests::query()
            ->where('supervisor', \Auth::user()->id)
            ->where("status",'WAITING_SUPERVISOR_APPROVAL')
            ->orderByDesc('id');
    }

    public function rowView(): string
    {
        return 'backend.jobs.supervisor.waiting-for-supervisor-approval-table-row';
    }
}
