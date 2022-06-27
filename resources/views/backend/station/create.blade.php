@extends('backend.layouts.app')

@section('title', __('Station'))
 
@section('content')
    <div>
    <form action="{{ url('addstationadmin') }}" method="post">
        {!! csrf_field() !!}
        <x-backend.card>
            <x-slot name="header">
                Station : Create
            </x-slot>

            <x-slot name="body">
                <!-- Station Name -->
                <div class="form-group row">
                    {!! Form::label('stationName', 'Station Name*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('stationName', '', ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('stationName')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                 
                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', '', ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('description')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square
                        image)
                        @error('thumb')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>      

                <!-- Capacity -->
                <div class="form-group row">
                    {!! Form::label('capacity', 'Capacity', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('capacity', '1', ['class'=>'form-control']) !!}
                        @error('capacity')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Create', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        </form>
    </div>
@endsection
