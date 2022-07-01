@extends('backend.layouts.app')

@section('title', __('Locker Detail'))

@section('breadcrumb-links')
@endsection

@section('content')
<div>
    {!! Form::open(['url' => route('admin.locker.details.store'),
        'method' => 'post',
        'class' => 'container',
        'files'=>true,
        'enctype'=>'multipart/form-data'
    ]) !!}

    <x-backend.card>
        <x-slot name="header">
            Locker : Create | ID - {{ $Locker_id }}
        </x-slot>

        <x-slot name="body">
            <!-- Locker Id -->
            <div class="form-group row">
                {!! Form::label('locker_id', 'Locker Id', ['class' => 'col-md-2 col-form-label']) !!}

                <div class="col-md-2">
                    {!! Form::text ('locker_id', $Locker_id , ['class'=>'form-control','readonly']) !!}
                    @error('locker_id')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>
        
            <!-- isAvailable -->
            <div class="form-group row">
                {!! Form::label('is_available', 'Available?', ['class' => 'col-md-2 col-form-label']) !!}

                <div class="col-md-4 d-flex align-items-center">
                    {!!Form::checkbox('is_available',true,  true); !!}
                    @error('is_available')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group row">
                {!! Form::label('notes', 'Notes', ['class' => 'col-md-2 col-form-label']) !!}

                <div class="col-md-10">
                    {!! Form::textarea('notes', '', ['class'=>'form-control', 'rows'=>3 ]) !!}
                    @error('notes')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>
            </div>

            <!-- Order Id -->
            <div class="form-group row">
                {!! Form::label('order_id', 'Order Id', ['class' => 'col-md-2 col-form-label']) !!}

                <div class="col-md-4">
                    {!! Form::select('order_id', $orders, null, ['class'=>'form-control', 'placeholder' => '']) !!}
                    @error('order_id')
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
