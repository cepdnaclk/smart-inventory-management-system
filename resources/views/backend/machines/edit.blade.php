@extends('backend.layouts.app')

@section('title', __('Machines'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.machines.update',
        compact('machines')),
        'method' => 'put',
        'class' => 'container',
        'files'=>true,
        'enctype'=>'multipart/form-data'
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Machines : Edit | {{ $machines->title  }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', $machines->title , ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('title')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <!-- Location -->
                <div class="form-group row">
                    {!! Form::label('location_label', 'Location*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('location', $locations, $this_item_location, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('location')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Color -->
                <!-- Type -->
                <div class="form-group row">
                    {!! Form::label('type', 'Type*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('type', $typeOptions, $machines->type, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('type')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Width -->
                    {!! Form::label('build_width', 'Width (mm)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                        {!! Form::number('build_width', $machines->build_width, ['class'=>'form-control']) !!}
                        @error('build_width')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Length -->
                    {!! Form::label('build_length', 'Length (mm)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                        {!! Form::number('build_length', $machines->build_length, ['class'=>'form-control']) !!}
                        @error('build_length')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Height -->
                    {!! Form::label('build_height', 'Height (mm)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                        {!! Form::number('build_height', $machines->build_height, ['class'=>'form-control']) !!}
                        @error('build_height')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Power -->
                <div class="form-group row">
                    {!! Form::label('title', 'Power (Watts)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('power', $machines->power, ['class'=>'form-control', 'required'=>false ]) !!}
                        @error('power')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Specifications -->
                <div class="form-group row">
                    {!! Form::label('specifications', 'Specifications', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('specifications', $machines->specifications, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('specifications')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group row">
                    {!! Form::label('status', 'Availability*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('status', $availabilityOptions, $machines->status, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('status')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $machines->thumbURL() }}" alt="" width="64">
                        {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square
                        image)
                        @error('thumb')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="form-group row">
                    {!! Form::label('notes', 'Additional Notes', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('notes', $machines->notes, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('notes')
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
