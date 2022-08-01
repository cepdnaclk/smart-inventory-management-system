<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Locations;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class LocationsTable extends DataTableComponent
{
    public array $perPageAccepted = [25, 50, 100, 200];
    public bool $perPageAll = true;

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
        return Locations::query()
            ->when($this->getFilter('location'), fn($query, $location) => $query->where('parent_location', $location));
    }

    public function filters(): array
    {
        // Add '' => "Any" to the beginning of the array
        $locations = ["" => "Any"];
        $locationList = Locations::all()->where('parent_location', 1)->all();

        foreach ($locationList as $key => $value) {
            $locations[$value->id] = $value->location;
        }

        return [
            'location' => Filter::make('Location')
                ->select($locations),
        ];
    }

    public function rowView(): string
    {
        return 'backend.locations.index-table-row';
    }
}
