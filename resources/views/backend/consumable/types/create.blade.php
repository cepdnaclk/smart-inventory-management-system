@extends('backend.layouts.app')

@section('title', __('Consumable Types'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.consumable.types.store'),
            'method' => 'post',
            'class' => 'container',
            'files'=>true,
            'enctype'=>'multipart/form-data'
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Consumable Types : Create
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title of the type*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', '', ['class'=>'form-control', 'required'=>true ]) !!}
                    </div>

                    @error('title')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="form-group row">
                    {!! Form::label('subtitle', 'Subtitle of the type', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('subtitle', '', ['class'=>'form-control']) !!}
                    </div>

                    @error('subtitle')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Parent Category -->
                <div class="form-group row">
                    {!! Form::label('parent_id', 'Parent Category', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('parent_id', $types, null, ['class'=>'form-control', 'required'=>false, 'placeholder' => '']) !!}
                        @error('parent_id')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', '', ['class'=>'form-control', 'rows'=>3, 'required'=>true ]) !!}
                    </div>

                    @error('description')
                    <strong>{{ $message }}</strong>
                    @enderror
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

            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Create', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        {!! Form::close() !!}
    </div>
@endsection
