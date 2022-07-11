@extends('backend.layouts.app')

@section('title', __('Reservation'))


@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Reservation : Show |    @if($reservation->res_info() != null)
                                            {{ $reservation->res_info['name'] }}
                                        @endif
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>                   
                            @if($reservation->res_info() != null)
                                {{ $reservation->res_info['name'] }}
                            @endif
                        </h4>
                    </div>

                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('frontend.reservation.edit', $reservation)}}"
                               class="btn btn-info btn-xs "><i class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a href="{{ route('frontend.reservation.delete', $reservation)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                                                                title="Delete"></i>
                            </a>
                        </div>
                    </div>
                   
                </div>
                <table class="table">

                    <tr>
                        <td>User ID</td>
                        <td>{{ $reservation->user_id }}</td>
                    </tr>

                    <tr>
                        <td>User Email</td>
                        <td>
                        @if($reservation->res_info() != null)
                            {{ $reservation->res_info['email'] }} 
                        @endif
                        </td>
                        
                    </tr>
                    
                    <tr>
                        <td>Start Date</td>
                        <td>{{ $reservation->start_date }}</td>
                    </tr>

                    <tr>
                        <td>End Date</td>
                        <td>{{ $reservation->end_date }}</td>
                    </tr>

                    <tr>
                        <td>Duration</td>
                        <td>{{ $reservation->duration }} minutes </td>
                    </tr>

                    <tr>
                        <td>Station Name</td>
                        <td>
                        @if($reservation->st_info() != null)
                            {{ $reservation->st_info['stationName'] }} 
                            (ID = {{ $reservation->st_info['id'] }})
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>E numbers</td>
                        <td>{{ $reservation->E_numbers }}</td>
                    </tr>

                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
