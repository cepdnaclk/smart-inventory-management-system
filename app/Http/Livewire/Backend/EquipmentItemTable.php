<?php

namespace App\Http\Livewire\Backend;

use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class EquipmentItemTable extends DataTableComponent
{
    public array $perPageAccepted = [25, 50, 100];
    public bool $perPageAll = true;

    public function columns(): array
    {
        return [
            Column::make("Code")
                ->sortable(),
            Column::make("Title", 'title')
                ->sortable()
                ->searchable(),
            Column::make("Product Code"),
            Column::make("Quantity", 'quantity')
                ->sortable(),
            Column::make("Category", 'equipment_type_id')
                ->sortable(),
            Column::make("Price (LKR)", 'price')
                ->sortable(),
            // Column::make("Dimensions (WxLxH cm)"),
            // Column::make("Weight (g)", "weight")
            //     ->sortable(),
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
        $categoriesFromDB = EquipmentType::pluck('title', 'id')->toArray();

        // Add '' => "Any" to the beginning of the array
        $categories = [''=> "Any"];
        $cat = EquipmentType::where('parent_id', NULL)->get();

        // For now, only support upto 3 levels
        foreach ($cat as $key => $value) {
            $categories[$value->id] = $value->title;
            // Level 2
            if ($value->children()->count() > 0) {
                foreach ($value->children() as $l) {
                    $categories[$l->id] = $l->getFullCategoryType();
                    // Level 3
                    if ($l->children()->count() > 0) {
                        foreach ($l->children() as $ll) {
                            $categories[$ll->id] = $ll->getFullCategoryType();
                        }
                    }
                }
            }
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
