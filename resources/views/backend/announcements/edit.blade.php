@extends('backend.layouts.app')

@section('title', __('Announcements'))

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.announcements.update',
                  compact('announcement')),
                  'method' => 'put',
                  'class' => 'container',
                  'files'=>true,
                  'enctype'=>'multipart/form-data'
      ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Announcements : Edit | {{ $announcement->id  }}
            </x-slot>

            <x-slot name="body">
                 <!-- Area -->
                <div class="form-group row">
                     {!! Form::label('area', 'Area*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::select('area', $areas, $announcement->area, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('area')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Type -->
                <div class="form-group row">
                    {!! Form::label('type', 'Type*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::select('type', $types,  $announcement->type, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('type')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Message -->
                <div class="form-group row">
                    {!! Form::label('message', 'Display Message*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('message',  $announcement->message, ['class'=>'form-control', 'rows'=>3, 'required'=>true, ]) !!}
                        @error('message')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Enabled -->
                <div class="form-group row">
                    {!! Form::label('enabled', 'Enabled*', ['class' => 'col-md-2 form-check-label']) !!}

                    <div class="col-md-4 form-check">
                        <input type="checkbox" name="enabled" value="1"
                               class="form-check-input0" {{ $announcement->enabled == 1 ? 'checked' :''}} />
                        @error('enabled')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                 </div>

                <!-- Starts at -->
                <div class="form-group row">
                    {!! Form::label('starts_at', 'Starts at*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::datetimeLocal('starts_at',  $announcement->starts_at, ['class'=>'form-control', 'required'=>true,]) !!}
                        @error('starts_at')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Ends at -->
                <div class="form-group row">
                    {!! Form::label('ends_at', 'Ends at*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::datetimeLocal('ends_at',  $announcement->ends_at, ['class'=>'form-control', 'required'=>true,]) !!}
                        @error('ends_at')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </x-slot>
            <x-slot name="footer">
                {!! Form::submit('Update', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>
        {!! Form::close() !!}
    </div>
@endsection
