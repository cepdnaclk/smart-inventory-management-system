<x-livewire-tables::table.cell>
    @if ($row->area == App\Domains\Announcement\Models\Announcement::TYPE_FRONTEND)
        Frontend
    @elseif($row->area == App\Domains\Announcement\Models\Announcement::TYPE_BACKEND)
        Backend
    @else
        Both
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ App\Domains\Announcement\Models\Announcement::types()[$row->type] }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->message }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->enabled ? 'Enabled' : 'Disabled' }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->starts_at }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->ends_at }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="d-flex px-0 mt-0 mb-0">
        <div class="btn-group" role="group" aria-label="">
            <a href="{{ route('admin.announcements.edit', $row) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"
                    title="Edit"></i>
            </a>
            <a href="{{ route('admin.announcements.delete', $row) }}" class="btn btn-danger btn-xs"><i
                    class="fa fa-trash" title="Delete"></i>
            </a>
        </div>
    </div>
</x-livewire-tables::table.cell>
