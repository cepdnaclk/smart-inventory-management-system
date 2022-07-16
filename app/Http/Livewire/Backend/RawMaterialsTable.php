<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\RawMaterials;

class RawMaterialsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Color", "color")
                ->sortable(),
            Column::make("Quantity", "quantity")
                ->sortable(),
            Column::make("Availability", "availability"),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return RawMaterials::query();
    }

    public function rowView(): string
    {
        return 'backend.raw_materials.index-table-row';
    }
}
