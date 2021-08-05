@extends('backend.layouts.app')

@section('title', __('Equipment Types'))

@section('breadcrumb-links')
@include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
<div>
    {!! Form::open(['url' => route('admin.equipment.types.store'),
        'method' => 'post',
        'class' => 'container',
        'files'=>true,
        'enctype'=>'multipart/form-data'
    ]) !!}

    <x-backend.card>
        <x-slot name="header">
            Equipment Types : Create
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
                    {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square image)
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
