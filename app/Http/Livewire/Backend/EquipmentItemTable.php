<?php

namespace App\Http\Livewire\Backend;

use App\Models\EquipmentItem;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ConsumableItem;

class EquipmentItemTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Code")
                ->sortable(),
            Column::make("Title", 'title')
                ->sortable()
                ->searchable(),
            Column::make("Product Code and Brand"),
            Column::make("Quantity", 'quantity')
                ->sortable(),
            Column::make("Category"),
            Column::make("Price (LKR)", 'price')
                ->sortable(),
            Column::make("Dimensions(cm) WxLxH"),
            Column::make("Weight (g)", "weight")
                ->sortable(),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return EquipmentItem::query();
    }

    public function rowView(): string
    {
        return 'backend.equipment.items.index-table-row';
    }
}
