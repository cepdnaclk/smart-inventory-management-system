@extends('backend.layouts.app')

@section('title', __('Machines'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.machines.store'),
            'method' => 'post',
            'class' => 'container',
            'files'=>true,
            'enctype'=>'multipart/form-data'
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Machines : Create
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', '', ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('title')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Type -->
                <div class="form-group row">
                    {!! Form::label('type', 'Type*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('type', $typeOptions, '', ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('type')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Width -->
                    {!! Form::label('build_width', 'Width (mm)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                        {!! Form::number('build_width', '', ['class'=>'form-control']) !!}
                        @error('build_width')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Length -->
                    {!! Form::label('build_length', 'Length (mm)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                        {!! Form::number('build_length', '', ['class'=>'form-control']) !!}
                        @error('build_length')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Height -->
                    {!! Form::label('build_height', 'Height (mm)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                        {!! Form::number('build_height', '', ['class'=>'form-control']) !!}
                        @error('build_height')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Power -->
                <div class="form-group row">
                    {!! Form::label('title', 'Power (Watts)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('power', '', ['class'=>'form-control', 'required'=>false ]) !!}
                        @error('power')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Specifications -->
                <div class="form-group row">
                    {!! Form::label('specifications', 'Specifications', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('specifications', '', ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('specifications')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group row">
                    {!! Form::label('status', 'Availability*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('status', $availabilityOptions, '', ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('status')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10 ">
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
                        {!! Form::textarea('notes', '', ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('notes')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Create', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        {!! Form::close() !!}
    </div>
@endsection
