<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Machines;

class MachinesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Type", "type")
                ->sortable(),
            Column::make("Build Capacity (WxLxH)"),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Lifespan", "lifespan")
                ->sortable(),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return Machines::query();
    }

    public function rowView(): string
    {
        return 'backend.machines.index-table-row';
    }
}
