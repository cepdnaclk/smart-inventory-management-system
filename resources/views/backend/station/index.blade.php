@extends('backend.layouts.app')

@section('title', __('Station'))

@section('breadcrumb-links')
    @include('backend.station.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Station
            </x-slot>

            @if ($logged_in_user->hasInventoryAccess())
                <x-slot name="headerActions">
                    <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.station.create')" :text="__('Create Station')">
                    </x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">

                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                <div class="container table-responsive pt-3">
                    <table class="table table-striped">
                        <tr>
                            <th>Station Name</th>
                            <th>Description</th>
                            <!-- <th>Thumbnail</th> -->
                            <th>Capacity</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach ($station as $st)
                            <tr>
                                <td>{{ $st->stationName }}</td>
                                <td>{{ $st->description }}</td>
                                <!-- <td>{{ $st->thumb }}</td> -->
                                <td>{{ $st->capacity }}</td>
                                <td>

                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.station.show', $st) }}"
                                                class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <a href="{{ route('admin.station.edit', $st) }}" class="btn btn-info btn-xs"><i
                                                    class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            <a href="{{ route('admin.station.delete', $st) }}"
                                                class="btn btn-danger btn-xs"><i class="fa fa-trash" title="Delete"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                    {{ $station->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
