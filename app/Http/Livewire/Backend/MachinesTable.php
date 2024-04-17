<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Machines;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class MachinesTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Code", "id")
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
        return Machines::query()
            ->when($this->getFilter('status'), fn($query, $status) => $query->where('status', $status))
            ->when($this->getFilter('type'), fn($query, $type) => $query->where('type', $type));
    }

    public function filters(): array
    {
        // Add '' => "Any" to the beginning of the array
        $status = ["" => "Any"];
        foreach (Machines::availabilityOptions() as $key => $value) {
            $status[$key] = $value;
        }

        $type = ["" => "Any"];
        foreach (Machines::types() as $key => $value) {
            $type[$key] = $value;
        }

        return [
            'status' => Filter::make('Status')
                ->select($status),
            'type' => Filter::make('Type')
                ->select($type),
        ];
    }


    public function rowView(): string
    {
        return 'backend.machines.index-table-row';
    }
}
