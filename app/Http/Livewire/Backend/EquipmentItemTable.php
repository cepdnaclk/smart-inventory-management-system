<?php

namespace App\Http\Livewire\Backend;

use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ConsumableItem;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use function Livewire\str;

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
            Column::make("Category", 'equipment_type_id')
                ->sortable(),
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
        return EquipmentItem::query()
            ->when($this->getFilter('category'), fn($query, $category) => $query->where('equipment_type_id', $category));
    }

    public function filters(): array
    {
        // Category ------------------------------------------------------
        $categoriesFromDB = EquipmentType::pluck('title','id')->toArray();

        // Add '' => "Any" to the beginning of the array
        $categories = array();
        $categories[''] = "Any";
        foreach ($categoriesFromDB as $key => $value) {
            $categories[$key] = $value;
        }


        return [
            'category' => Filter::make('Category')
                ->select($categories)
        ];
    }

    public function rowView(): string
    {
        return 'backend.equipment.items.index-table-row';
    }
}
