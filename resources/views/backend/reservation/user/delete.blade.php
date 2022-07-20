@extends('backend.layouts.app')

@section('title', __('Reservation')) 


@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Reservation : Delete | {{ $reservation->id  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete the reservation for 
                    <strong><i>{{ $reservation->E_numbers }} </i></strong> made on
                    <strong><i>{{ $reservation->start_date }} </i></strong> for 
                    <strong><i>{{ $station->stationName }} </i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('frontend.reservation.destroy', compact('reservation') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('frontend.reservation.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
