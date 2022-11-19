<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ConsumableType;

class ConsumableTypeTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Code", "id")
                ->sortable(),
            Column::make("Title",'title')
                ->sortable()
                ->searchable(),
            Column::make("Parent Category",'parent_id'),
            Column::make("Description",'description'),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return ConsumableType::query();
    }

    public function rowView(): string
    {
        return 'backend.consumable.types.index-table-row';
    }
}
