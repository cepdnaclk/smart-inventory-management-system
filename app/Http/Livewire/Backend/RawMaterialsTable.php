<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use App\Models\RawMaterials;

class RawMaterialsTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Code", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Color", "color")
                ->sortable()
                ->searchable(),
            Column::make("Quantity", "quantity")
                ->sortable(),
            Column::make("Availability", "availability"),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return RawMaterials::query()
            ->when($this->getFilter('availability'), fn($query, $availability) => $query->where('availability', $availability));
    }

    public function filters(): array
    {
        // Add '' => "Any" to the beginning of the array
        $availabilities = ["" => "Any"];
        foreach (RawMaterials::availabilityOptions() as $key => $value) {
            $availabilities[$key] = $value;
        }

        return [
            'availability' => Filter::make('Availability')
                ->select($availabilities)
        ];
    }

    public function rowView(): string
    {
        return 'backend.raw_materials.index-table-row';
    }
}
