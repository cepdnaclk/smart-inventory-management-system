@extends('backend.layouts.app')

@section('title', __('Equipment'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.equipment.items.store'),
            'method' => 'post',
            'class' => 'container',
            'files'=>true,
            'enctype'=>'multipart/form-data'
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Equipment : Create
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

                <!-- Category -->
                <div class="form-group row">
                    {!! Form::label('equipment_type_id', 'Category*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('equipment_type_id', $types, null, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('equipment_type_id')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <!-- Location -->
                <div class="form-group row">
                    {!! Form::label('location_label', 'Location*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('location', $locations, null, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('location')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Brand -->
                    {!! Form::label('brand', 'Brand', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('brand', '', ['class'=>'form-control']) !!}
                        @error('brand')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Product Code -->
                    {!! Form::label('productCode', 'Product Code', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('productCode', '', ['class'=>'form-control']) !!}
                        @error('productCode')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Is Electrical -->
                    {!! Form::label('isElectrical', 'Electrical Item', ['class' => 'col-md-2 form-check-label']) !!}

                    <div class="col-md-4 form-check">
                        {!! Form::checkbox('isElectrical', '1', ['class'=>'form-check-input']) !!}
                        @error('isElectrical')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Power Rating -->
                    {!! Form::label('powerRating', 'Power Rating (Watts)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('powerRating', '', ['class'=>'form-control']) !!}
                        @error('powerRating')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', '', ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('description')
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

                <!-- Usage Instructions -->
                <div class="form-group row">
                    {!! Form::label('instructions', 'Usage Instructions', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('instructions', '', ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('instructions')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Dimensions -->
                <div class="form-group row">
                    {!! Form::label('dimensions', 'Dimensions', ['class' => 'col-sm-2 form-label']) !!}

                    <div class="col-md-3 form-group mb-2">
                        <div class="container row">
                            {!! Form::label('width', 'Width (cm)', ['class' => 'form-label']) !!}<br/>
                            {!! Form::number('width', '', ['class'=>'form-control', 'step' => '0.1']) !!}
                            @error('width')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 form-group mb-2">
                        <div class="container row">
                            {!! Form::label('height', 'Height (cm)', ['class' => 'form-label']) !!}<br/>
                            {!! Form::number('height', '', ['class'=>'form-control', 'step' => '0.1']) !!}
                            @error('height')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 form-group mb-2">
                        <div class="container row">
                            {!! Form::label('length', 'Length (cm)', ['class' => 'form-label']) !!}<br/>
                            {!! Form::number('length', '', ['class'=>'form-control', 'step' => '0.1']) !!}
                            @error('length')
                            <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Weight -->
                <div class="form-group row">
                    {!! Form::label('weight', 'Weight (g)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('weight', '', ['class'=>'form-control', 'step' => '0.1']) !!}
                        @error('weight')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Price -->
                <div class="form-group row">
                    {!! Form::label('price', 'Price (LKR)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('price', '0', ['class'=>'form-control']) !!}
                        @error('price')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Count -->
                <div class="form-group row">
                    {!! Form::label('quantity', 'Quantity', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('quantity', '1', ['class'=>'form-control']) !!}
                        @error('quantity')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
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
