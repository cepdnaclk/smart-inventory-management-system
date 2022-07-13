@extends('backend.layouts.app')

@section('title', __('Reservation'))


@section('content')
    <div>
    {!! Form::open(['url' => route('frontend.reservation.update',
                  compact('reservation')),
                  'method' => 'put',
                  'class' => 'container',
                  'files'=>true,
                  'enctype'=>'multipart/form-data'
      ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Reservation : Edit 
            </x-slot>

            <x-slot name="body">
                <!-- Station name -->
                <div class="form-group row">
                    {!! Form::label('station_id', 'Station*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('station_id', $stations, null , ['class'=>'form-control', 'required'=>true, 'placeholder' => $station->stationName]) !!}
                        @error('station_id')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Start Date -->
                <div class="form-group row">

                    {!! Form::label('start_date', 'Start date*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-3">
                        {!! Form::text('start_date', $reservation->start_date, ['type' => 'datetime-local', 'class'=>'form-control datepicker', 'required'=>true, 'placeholder' => 'Date']) !!}
                        @error('start_date')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- End Date -->
                <div class="form-group row">

                    {!! Form::label('end_date', 'End date*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-3">
                        {!! Form::text('end_date', $reservation->end_date, ['class'=>'form-control datepicker', 'required'=>true, 'placeholder' => 'Date']) !!}
                        @error('end_date')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- E numbers -->
                <div class="form-group row">
                    {!! Form::label('E_numbers', 'E- Numbers*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('E_numbers', $reservation->E_numbers , ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('E_numbers')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image before Usage -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail Before Usage', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $reservation->thumbURL() }}" alt="" width="64">
                        {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square
                        image)
                        @error('thumb')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image after Usage -->
                <div class="form-group row">
                    {!! Form::label('thumb_after', 'Thumbnail After Usage', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $reservation->thumbURL_after() }}" alt="" width="64">
                        {!! Form::file('thumb_after', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square
                        image)
                        @error('thumb_after')
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
