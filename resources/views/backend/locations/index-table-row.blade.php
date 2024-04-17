<x-livewire-tables::table.cell>
    {{ $row->id }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->getFullLocationAddress() }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="d-flex px-0 mt-0 mb-0">
        <div class="btn-group" role="group" aria-label="Basic example">
            @if ($row->location != "MakerSpace")
                <a href=" {{route('admin.locations.edit', $row) }}"
                   class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                </a>
                <a href="{{ route('admin.locations.delete', $row) }}"
                   class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                    title="Delete"></i>
                </a>
            @else
                <p>[Not Editable]</p>
            @endif
        </div>
    </div>
</x-livewire-tables::table.cell>
