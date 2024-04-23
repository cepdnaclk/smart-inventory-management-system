@extends('backend.layouts.app')

@section('title', __('Station'))

@section('breadcrumb-links')
    @include('backend.station.includes.breadcrumb-links')
@endsection 

@section('content')
    <div>
    {!! Form::open(['url' => route('admin.station.update',
                  compact('station')),
                  'method' => 'put',
                  'class' => 'container',
                  'files'=>true,
                  'enctype'=>'multipart/form-data'
      ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Station : Edit | {{ $station->stationName  }}
            </x-slot>

            <x-slot name="body">
                <!-- Station name -->
                <div class="form-group row">
                    {!! Form::label('stationName', 'Station Name*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('stationName', $station->stationName , ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('stationName')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', $station->description, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('description')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Capacity -->
                <div class="form-group row">
                    {!! Form::label('capacity', 'Capacity', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('capacity', $station->capacity, ['class'=>'form-control']) !!}
                        @error('capacity')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $station->thumbURL() }}" alt="" width="64">
                        {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square
                        image)
                        @error('thumb')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </x-slot>
            <x-slot name="footer">
                {!! Form::submit('Update', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>
        </form>
    </div>
@endsection
