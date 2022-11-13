@extends('backend.layouts.app')

@section('title', __('Locations'))

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Locations
            </x-slot>

            <x-slot name="body">
                {!! Form::open(['url' => route('admin.locations.update', $location->id),
           'method' => 'post',
           'class' => 'container'
       ]) !!}
                <div class="form-group row">
                    {!! Form::label('locationName', 'Location Name*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('locationName', $location->location, ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('title')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('parentLocation', 'Parent Location*', ['class' => 'col-md-2 col-form-label']) !!}
                    <div class="col-md-10">
                        {!! Form::select('parentLocation', $locations, $location->get_parent_location->id, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('equipment_type_id')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>


                <x-slot name="footer">
                    {!! Form::submit('Update', ['class'=>'btn btn-primary float-right']) !!}
                </x-slot>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
