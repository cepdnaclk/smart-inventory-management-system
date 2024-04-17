<x-livewire-tables::table.cell>
    Job #{{ $row->id }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
        {{ \App\Models\JobRequests::job_status()[$row->status]  }}
</x-livewire-tables::table.cell>


<x-livewire-tables::table.cell>
    @if($row->machine_info() != null)
        <a href="{{ route('admin.machines.show', $row->machine) }}" target="_blank">
            {{ $row->machine_info['title'] }}
        </a>
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->material_info() != null)
        <a href="{{ route('admin.raw_materials.show', $row->material) }}"
           target="_blank">
            {{ $row->material_info['title'] }}
        </a>
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->supervisor_info() != null)
        {{ $row->supervisor_info['name'] }}
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="d-flex justify-content-end">
    <div class="btn-group" role="group">
        <a href="{{ route('admin.jobs.supervisor.show', $row)}}"
           class="btn btn-primary btn-xs">
            <i class="fa fa-check" title="Approval"></i>
        </a>
    </div>
</x-livewire-tables::table.cell>



