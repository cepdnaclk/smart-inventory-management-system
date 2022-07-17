@extends('backend.layouts.app')

@section('title', __('Reservation'))

@section('breadcrumb-links')
    @include('backend.reservation.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Reservation
            </x-slot>

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
                            <th>User Name</th>
                            <th>Station Name</th>
                            <th>Start Date & Time</th>
                            <th>End Date & Time</th>
                            <th>Duration<br>(in minutes)</th>
                            <th>Team</th>
                            <th>&nbsp;</th>
                        </tr>

                        @foreach($reservation as $res)
                            <tr>
                            <!-- <td>{{ $res->user_id  }}</td> -->

                                <td>
                                    @if($res->res_info() != null)
                                        {{ $res->res_info['name'] }}
                                    @endif
                                </td>
                            <!-- <td>{{ $res->station_id }}</td> -->
                                <td>
                                    @if($res->st_info() != null)
                                        {{ $res->st_info['stationName'] }}
                                    @endif
                                </td>
                                <td>{{ $res->start_date }}</td>
                                <td>{{ $res->end_date }}</td>
                                <td>{{ $res->duration }}</td>
                                <td>{{ $res->E_numbers }}</td>

                                <td>

                                    <div class="d-flex px-0 mt-0 mb-0">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.reservation.show', $res)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                    {{ $reservation->links() }}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection