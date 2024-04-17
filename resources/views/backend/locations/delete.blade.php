@extends('backend.layouts.app')

@section('title', __('Locations'))

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Locations
            </x-slot>


            <x-slot name="body">
                <p>Deleting this location will delete any children locations, along with the records of which items are at this location.
                    <br>
                    Are you sure you want to delete
                    <strong><i>{{ $location->location  }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.locations.destroy', compact('location') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.locations.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
