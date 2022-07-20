<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\JobRequests;

class FabricationsTechOfficerTable extends DataTableComponent
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
            Column::make("Supervisor", "supervisor")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return JobRequests::query()
            ->where('status', "WAITING_TO_APPROVAL")
            // TODO: This needs to checked. Not sure if its working properly.
            // This needs to be equal with \App\Models\JobRequests::jobsForTechOfficer()
            // Resulting query is this -> select count(*) as aggregate from "job_requests" where "status" = 'WAITING_TO_APPROVAL' or "status" = 'PENDING_FABRICATION'
            ->orWhere('status', "PENDING_FABRICATION")
            ->orderByDesc('id');
    }

    public function rowView(): string
    {
        return 'backend.jobs.technical-officer.table-row';
    }
}
