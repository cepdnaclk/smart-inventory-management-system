<?php

namespace App\Http\Livewire\Backend;

use App\Models\ComponentType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ComponentItem;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class ComponentItemTable extends DataTableComponent
{
    public array $perPageAccepted = [25, 50, 100];
    public bool $perPageAll = true;

    public function columns(): array
    {
        return [
            Column::make("Code", "id")
                ->sortable(),
            Column::make("Title", "title")
                ->sortable()
                ->searchable(),
            Column::make("Product Code and Brand"),
            Column::make("Category")
                ->sortable()
                ->searchable(),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return ComponentItem::query()
            ->when($this->getFilter('category'), fn ($query, $category) => $query->where('component_type_id', $category));;
    }

    public function filters(): array
    {
        // Category ------------------------------------------------------
        $categoriesFromDB = ComponentType::pluck('title', 'id')->toArray();

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
        return 'backend.component.items.index-table-row';
    }
}