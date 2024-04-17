@extends('backend.layouts.app')

@section('title', __('Consumable'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open([
            'url' => route('admin.consumable.items.store'),
            'method' => 'post',
            'class' => 'container',
            'files' => true,
            'enctype' => 'multipart/form-data',
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Consumable : Create
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', '', ['class' => 'form-control', 'required' => true]) !!}
                        @error('title')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Category -->
                <div class="form-group row">
                    {!! Form::label('consumable_type_id', 'Category*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('consumable_type_id', $types, null, [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => '',
                        ]) !!}
                        @error('consumable_type_id')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Specifications -->
                <div class="form-group row">
                    {!! Form::label('specifications', 'Specifications', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('specifications', '', ['class' => 'form-control', 'rows' => 3]) !!}
                        @error('specifications')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Quantity -->
                <div class="form-group row">
                    {!! Form::label('quantity', 'Quantity', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('quantity', '', ['class' => 'form-control']) !!}
                        @error('quantity')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Price -->
                <div class="form-group row">
                    {!! Form::label('price', 'Price (LKR)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('price', '', ['class' => 'form-control', 'step' => '0.01']) !!}
                        @error('price')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                
                <!-- Form Factor -->
                <div class="form-group row">
                    {!! Form::label('formFactor', 'Form Factor', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('formFactor', '', ['class' => 'form-control']) !!}
                        @error('formFactor')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- DatasheetURL -->
                <div class="form-group row">
                    {!! Form::label('datasheetURL', 'Datasheet URL', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('datasheetURL', '', ['class' => 'form-control']) !!}
                        @error('datasheetURL')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::file('thumb', ['accept' => '.jpeg,.png,.jpg,.gif,.svg']) !!} (Max: 2MB, use square
                        image)

                        @error('thumb')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Create', ['class' => 'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        {!! Form::close() !!}
    </div>
@endsection
