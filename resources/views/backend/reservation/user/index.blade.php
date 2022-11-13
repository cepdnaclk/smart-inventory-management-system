@extends('backend.layouts.app')

@section('title', __('Reservation'))

@section('breadcrumb-links')
    @include('backend.reservation.user.breadcrumb-links')
@endsection

@section('content') 
    <div>
        <x-backend.card>
            <x-slot name="header">
                Reservations: {{ $userLoggedin['name'] }}
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">
                    <x-utils.link
                            icon="c-icon cil-plus"
                            class="card-header-action"
                            :href="route('frontend.stations.index')"
                            :text="__('Create Reservation')"></x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">

                <!-- Redirection messages according to success or failure -->
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(session('Error'))
                    <div class="alert alert-danger">
                        {{ session('Error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Create table -->
                <div class="container table-responsive pt-3">
                    <table class="table table-striped">
                        <tr>
                            <th>Station Name</th>
                            <th>Start Date & Time</th>
                            <th>End Date & Time</th>
                            <th>Duration<br>(in minutes)</th>
                            <th>Team</th>
                            <th>&nbsp;</th>
                        </tr>

                        <!-- Display all reservations made by the user -->
                        @foreach($reservation as $res)
                            <tr>
                                
                                
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
                                            <!-- Show -->
                                            <a href="{{ route('frontend.reservation.show', $res)}}"
                                               class="btn btn-secondary btn-xs"><i class="fa fa-eye" title="Show"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('frontend.reservation.edit', $res)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>
                                            </a>

                                            <!-- Delete -->
                                            <a href="{{ route('frontend.reservation.delete', $res)}}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                                                title="Delete"></i>
                                            </a>
                                            
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>

                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection