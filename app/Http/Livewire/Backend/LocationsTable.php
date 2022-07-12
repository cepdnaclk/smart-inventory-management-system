<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Locations;

class LocationsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Location Name", "location")
                ->sortable()
                ->searchable(),
            Column::make("Actions")

        ];
    }

    public function query(): Builder
    {
        return Locations::query();
    }

    public function rowView(): string
    {
        return 'backend.locations.index-table-row';
    }
}
