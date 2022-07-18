<x-livewire-tables::table.cell>
    {{ $row->inventoryCode() }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->title }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->types()[$row->type] }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->build_width != null && $row->build_length != null && $row->build_height!= null )
        {{ $row->build_width }} x {{ $row->build_length }}
        x {{$row->build_height }} mm
    @else
        N/A
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->availabilityOptions()[$row->status] }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->lifespanString() }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="d-flex px-0 mt-0 mb-0">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('admin.machines.show', $row)}}"
               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
            </a>

            <a href="{{ route('admin.machines.edit', $row)}}"
               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
            </a>
            <a href="{{ route('admin.machines.edit.location', $row)}}"
               class="btn btn-warning btn-xs"><i class="fa fa-map-marker"
                                                 title="Edit Location"></i>
            </a>
            <a href="{{ route('admin.machines.delete', $row)}}"
               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                title="Delete"></i>
            </a>
        </div>
    </div>
</x-livewire-tables::table.cell>
