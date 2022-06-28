@extends('backend.layouts.app')

@section('title', __('Station'))


@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Station
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            href="{{ url('/addstationadmin/create') }}"
                            :text="__('Create Station')"></x-utils.link>
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

                <div class="container table-responsive pt-3">
                    <table class="table table-striped">
                        <tr>
                            <th>Station Name</th>
                            <th>Description</th>
                            <th>Thumbnail</th>
                            <th>Capacity</th>
                            <th>&nbsp;</th>
                        </tr>
                        
                        @foreach($station as $st)
                            <tr>
                                <td>{{ $st->stationName  }}</td>
                                <td>{{ $st->description }}</td>
                                <td>{{ $st->thumb }}</td>
                                <td>{{ $st->capacity }}</td>
                                <td>

                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ url('/addstationadmin/' . $st->id) }}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <a href="{{ url('/addstationadmin/' . $st->id . '/edit') }}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                            </a>
                                            <a href="{{ url('/addstationadmin/' . $st->id . '/delete') }}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"
                                                                                title="Delete"></i>
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