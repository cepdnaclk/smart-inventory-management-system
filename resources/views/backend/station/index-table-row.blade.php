<x-livewire-tables::table.cell>
    {{ $row->id }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->stationName }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->description }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->capacity }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="d-flex px-0 mt-0 mb-0">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('admin.station.show', $row)}}"
               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
            </a>

            <a href="{{ route('admin.station.edit', $row)}}"
               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
            </a>
            <a href="{{ route('admin.station.delete', $row)}}"
               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                title="Delete"></i>
            </a>
        </div>
    </div>
</x-livewire-tables::table.cell>