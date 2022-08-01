<x-livewire-tables::table.cell>
     {{ $row->inventoryCode() }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
     {{ $row->title }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
     @if( $row->parent_id() != null)
        <a href="{{ route('admin.equipment.types.show', $row->parent_id() ) }}">
            {{ $row->parent()->first()->title }}
        </a>
     @else
        N/A
     @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
     {{ $row->description }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
     <div class="d-flex px-0 mt-0 mb-0">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('admin.equipment.types.show', $row)}}"
               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
            </a>

            <a href="{{ route('admin.equipment.types.edit', $row)}}"
               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
            </a>
            <a href="{{ route('admin.equipment.types.delete', $row)}}"
               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                title="Delete"></i>
            </a>
        </div>
    </div>
</x-livewire-tables::table.cell>