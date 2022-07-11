<?php

namespace App\Http\Livewire\Backend;

use App\Models\ConsumableType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ConsumableItem;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class ConsumableItemTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Code", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Category", "consumable_type_id"),
            Column::make("Form Factor", "formFactor"),
            Column::make("Quantity", "quantity"),
            Column::make("Actions"),
        ];
    }

    public function query(): Builder
    {
        return ConsumableItem::query()
            ->when($this->getFilter('category'), fn($query, $category) => $query->where('consumable_type_id', $category));
        ;
    }

    public function filters(): array
    {
        // Category ------------------------------------------------------
        $categoriesFromDB = ConsumableType::pluck('title','id')->toArray();

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
        return 'backend.consumable.items.index-table-row';
    }

}
