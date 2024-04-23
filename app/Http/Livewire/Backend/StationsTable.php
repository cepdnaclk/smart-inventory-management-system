<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Stations;

class StationsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Code", "id")
                ->sortable(),
            Column::make("Station Name", "stationName")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description"),
            Column::make("Capacity", "capacity"),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return Stations::query();
    }

    public function rowView(): string
    {
        return 'backend.station.index-table-row';
    }
}
