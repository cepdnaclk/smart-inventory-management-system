@extends('backend.layouts.app')

@section('title', __('Component Types'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.component.types.update',
                   compact('componentType')),
                   'method' => 'put',
                   'class' => 'container',
                   'files'=>true,
                   'enctype'=>'multipart/form-data'
       ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Component Types : Edit {{ $componentType->title }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title of the type*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', $componentType->title, ['class'=>'form-control', 'required'=>true ]) !!}
                    </div>

                    @error('title')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="form-group row">
                    {!! Form::label('subtitle', 'Subtitle of the type', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('subtitle', $componentType->subtitle, ['class'=>'form-control']) !!}
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
                        {!! Form::textarea('description', $componentType->description, ['class'=>'form-control', 'rows'=>3, 'required'=>true ]) !!}
                    </div>

                    @error('description')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $componentType->thumbURL() }}" alt="" width="64">
                        {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square
                        image)
                        @error('thumb')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Save', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        {!! Form::close() !!}
    </div>
@endsection
