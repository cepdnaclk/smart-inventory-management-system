<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Announcement\Models\Announcement;
use App\Models\ComponentType;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class AnnouncementTable extends DataTableComponent
{
    public array $perPageAccepted = [25, 50, 100];
    public bool $perPageAll = true;

    public function columns(): array
    {
        return [
            Column::make("Display Area", "area")
                ->sortable(),
            Column::make("Type", "type")
                ->sortable(),
            Column::make("Message", "message")
                ->searchable(),
            Column::make("Enabled", "enabled")
                ->searchable(),
            Column::make("Start", "starts_at"),
            Column::make("End", "ends_at"),
            Column::make("Actions")
        ];
    }

    public function query(): Builder
    {
        return Announcement::query()
            ->when($this->getFilter('area'), fn ($query, $status) => $query->where('area', $status))
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type));
    }

    public function filters(): array
    {
        $type = ["" => "Any"];
        foreach (Announcement::types() as $key => $value) {
            $type[$key] = $value;
        }
        $area = ["" => "Any"];
        foreach (Announcement::areas() as $key => $value) {
            $area[$key] = $value;
        }

        return [
            'area' => Filter::make('Display Area')
                ->select($area),
            'type' => Filter::make('Type')
                ->select($type),
        ];
    }

    public function rowView(): string
    {
        return 'backend.announcements.index-table-row';
    }
}