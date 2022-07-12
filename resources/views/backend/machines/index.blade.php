@extends('backend.layouts.app')

@section('title', __('Machines'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Machines
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('admin.machines.create')"
                            :text="__('Create Machine')"></x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">

                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <livewire:backend.machines-table />
{{--                <div class="container table-responsive pt-3">--}}
{{--                    <table class="table table-striped">--}}
{{--                        <tr>--}}
{{--                            <th>Title</th>--}}
{{--                            <th>Type</th>--}}
{{--                            <th>Build Capacity (W x L x H)</th>--}}
{{--                            <th>Status</th>--}}
{{--                            <th>Lifespan</th>--}}
{{--                            <th>&nbsp;</th>--}}
{{--                        </tr>--}}

{{--                        @foreach($machines as $machine)--}}

{{--                            <tr>--}}
{{--                                <td>{{ $machine->title  }}</td>--}}
{{--                                <td>{{ \App\Models\Machines::types()[$machine->type] }}</td>--}}
{{--                                <td>--}}
{{--                                    @if($machine->build_width != null && $machine->build_length != null && $machine->build_height!= null )--}}
{{--                                        {{ $machine->build_width }} x {{ $machine->build_length }}--}}
{{--                                        x {{ $machine->build_height }} mm--}}
{{--                                    @else--}}
{{--                                        N/A--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>{{ \App\Models\Machines::availabilityOptions()[$machine->status] }}</td>--}}
{{--                                <td>{{ $machine->lifespanString() }}</td>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex px-0 mt-0 mb-0">--}}
{{--                                        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                            <a href="{{ route('admin.machines.show', $machine)}}"--}}
{{--                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>--}}
{{--                                            </a>--}}

{{--                                            <a href="{{ route('admin.machines.edit', $machine)}}"--}}
{{--                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('admin.machines.edit.location', $machine)}}"--}}
{{--                                               class="btn btn-warning btn-xs"><i class="fa fa-map-marker"--}}
{{--                                                                                 title="Edit Location"></i>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('admin.machines.delete', $machine)}}"--}}
{{--                                               class="btn btn-danger btn-xs"><i class="fa fa-trash"--}}
{{--                                                                                title="Delete"></i>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}

{{--                    {{ $machines->links() }}--}}
{{--                </div>--}}
            </x-slot>
        </x-backend.card>
    </div>
@endsection
