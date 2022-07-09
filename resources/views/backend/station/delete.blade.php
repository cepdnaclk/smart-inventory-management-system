@extends('backend.layouts.app')

@section('title', __('Station'))

@section('breadcrumb-links')
    @include('backend.station.includes.breadcrumb-links')
@endsection  

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Station : Delete | {{ $station->stationName  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>{{ $station->stationName  }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.station.destroy', compact('station') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.station.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
