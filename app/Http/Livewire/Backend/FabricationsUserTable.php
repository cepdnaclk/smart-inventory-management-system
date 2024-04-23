<?php

namespace App\Http\Livewire\Backend;

use App\Models\JobRequests;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class FabricationsUserTable extends DataTableComponent
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
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return JobRequests::query()
            ->where('student', \Auth::user()->id)
            ->orderByDesc('id');
    }

    public function rowView(): string
    {
        return 'backend.jobs.student.student-table-row';
    }
}
