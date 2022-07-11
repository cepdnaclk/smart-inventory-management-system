<x-livewire-tables::table.cell>
    {{$row->inventoryCode() }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->title }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->productCode ?? 'N/A' }} <br>({{ $row->brand ?? 'N/A' }})
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->quantity }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->equipment_type() != null)
        <a href="{{ route('admin.equipment.types.show', $row->equipment_type) }}">
            {{ $row->equipment_type['title'] }}
        </a>
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
        {{ $row->price }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->width }} x {{ $row->height }} x {{ $row->length }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->weight }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
        <div class="d-flex px-0 mt-0 mb-0">
                <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('admin.equipment.items.show', $row)}}"
                           class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                        </a>

                        <a href="{{ route('admin.equipment.items.edit', $row)}}"
                           class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                        </a>
                        <a href="{{ route('admin.equipment.items.edit.location', $row)}}"
                           class="btn btn-warning btn-xs"><i class="fa fa-map-marker" title="Edit Location"></i>
                        </a>
                        <a href="{{ route('admin.equipment.items.delete', $row)}}"
                           class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                            title="Delete"></i>
                        </a>
                </div>
        </div>
</x-livewire-tables::table.cell>



