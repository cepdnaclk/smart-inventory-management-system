@extends('backend.layouts.app')

@section('title', __('Consumable Types'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.consumable.types.update',
                   compact('consumableType')),
                   'method' => 'put',
                   'class' => 'container',
                   'files'=>true,
                   'enctype'=>'multipart/form-data'
       ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Consumable Types : Edit {{ $consumableType->title }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title of the type*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', $consumableType->title, ['class'=>'form-control', 'required'=>true ]) !!}
                    </div>

                    @error('title')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="form-group row">
                    {!! Form::label('subtitle', 'Subtitle of the type', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('subtitle', $consumableType->subtitle, ['class'=>'form-control']) !!}
                    </div>

                    @error('subtitle')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Parent Category -->
                <div class="form-group row">
                    {!! Form::label('parent_id', 'Parent Category', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('parent_id', $types, $consumableType->parent_id, ['class'=>'form-control', 'required'=>false, 'placeholder' => '']) !!}
                        @error('parent_id')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', $consumableType->description, ['class'=>'form-control', 'rows'=>3, 'required'=>true ]) !!}
                    </div>

                    @error('description')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $consumableType->thumbURL() }}" alt="" width="64">
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
