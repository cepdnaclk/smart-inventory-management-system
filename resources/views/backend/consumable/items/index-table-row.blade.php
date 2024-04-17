<x-livewire-tables::table.cell>
    {{ $row->inventoryCode() }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->title }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->consumable_type() != null)
        <a href="{{ route('admin.consumable.types.show', $row->consumable_type) }}">
            {{ $row->consumable_type['title'] }}
        </a>
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if ($row->formFactor == '')
        N/A
    @else
        {{ $row->formFactor }}
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->quantity }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="d-flex px-0 mt-0 mb-0">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('admin.consumable.items.show', $row)}}"
               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
            </a>

            <a href="{{ route('admin.consumable.items.edit', $row)}}"
               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
            </a>
            <a href="{{ route('admin.consumable.items.edit.location', $row)}}"
               class="btn btn-warning btn-xs"><i class="fa fa-map-marker"
                                                 title="Edit Location"></i>
            </a>
            <a href="{{ route('admin.consumable.items.delete', $row)}}"
               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                title="Delete"></i>
            </a>
        </div>
    </div>
</x-livewire-tables::table.cell>