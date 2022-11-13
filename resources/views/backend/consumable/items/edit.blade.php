@extends('backend.layouts.app')

@section('title', __('Consumable'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open([
            'url' => route('admin.consumable.items.update', compact('consumableItem')),
            'method' => 'put',
            'class' => 'container',
            'files' => true,
            'enctype' => 'multipart/form-data',
        ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Consumable : Edit | {{ $consumableItem->title }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', $consumableItem->title, ['class' => 'form-control', 'required' => true]) !!}
                        @error('title')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Category -->
                <div class="form-group row">
                    {!! Form::label('consumable_type_id', 'Category*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('consumable_type_id', $types, $consumableItem->consumable_type_id, [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => '',
                        ]) !!}
                        @error('consumable_type_id')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>


                <div class="col-md-4">
                    {!! Form::select('location', $locations, $this_item_location, [
                        'class' => 'form-control',
                        'required' => true,
                        'placeholder' => '',
                    ]) !!}
                    @error('location')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
    </div>

    {{--                <div class="form-group row"> --}}
    {{--                    <!-- Brand --> --}}
    {{--                    {!! Form::label('brand', 'Brand', ['class' => 'col-md-2 col-form-label']) !!} --}}

    {{-- <!-- Product Code --> --}}
    {{-- {!! Form::label('productCode', 'Product Code', ['class' => 'col-md-2 col-form-label']) !!} --}}

    {{-- <div class="col-md-4"> --}}
    {{-- {!! Form::text('productCode', $consumableItem->productCode, ['class'=>'form-control']) !!} --}}
    {{-- @error('productCode') --}}
    {{-- <strong>{{ $message }}</strong> --}}
    {{-- @enderror --}}
    {{-- </div> --}}
    {{-- </div> --}}


    {{-- <!-- Description --> --}}
    {{-- <div class="form-group row"> --}}
    {{-- {!! Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label']) !!} --}}

    {{-- <div class="col-md-10"> --}}
    {{-- {!! Form::textarea('description', $consumableItem->description, ['class'=>'form-control', 'rows'=>3 ]) !!} --}}
    {{-- @error('description') --}}
    {{-- <strong>{{ $message }}</strong> --}}
    {{-- @enderror --}}
    {{-- </div> --}}
    {{-- </div> --}}

    <!-- Specifications -->
    <div class="form-group row">
        {!! Form::label('specifications', 'Specifications', ['class' => 'col-md-2 col-form-label']) !!}

        <div class="col-md-10">
            {!! Form::textarea('specifications', $consumableItem->specifications, ['class' => 'form-control', 'rows' => 3]) !!}
            @error('specifications')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>

    {{-- <!-- Usage Instructions --> --}}
    {{-- <div class="form-group row"> --}}
    {{-- {!! Form::label('instructions', 'Usage Instructions', ['class' => 'col-md-2 col-form-label']) !!} --}}

    {{-- <div class="col-md-10"> --}}
    {{-- {!! Form::textarea('instructions', $consumableItem->instructions, ['class'=>'form-control', 'rows'=>3 ]) !!} --}}
    {{-- @error('instructions') --}}
    {{-- <strong>{{ $message }}</strong> --}}
    {{-- @enderror --}}
    {{-- </div> --}}
    {{-- </div> --}}

    <!-- Dimensions -->
    <!-- TODO: Review this -->
    {{-- <div class="form-group row"> --}}
    {{-- {!! Form::label('size', 'Size', ['class' => 'col-sm-2 form-label']) !!} --}}

    {{-- <div class="col-md-10"> --}}
    {{-- {!! Form::select('size', ['very small'=>'very small', 'small'=> 'small', 'medium'=> 'medium','regular'=>'regular', 'large'=>'large','very large'=> 'very large'], $consumableItem->size, ['class'=>'form-control']) !!} --}}
    {{-- @error('size') --}}
    {{-- <strong>{{ $message }}</strong> --}}
    {{-- @enderror --}}
    {{-- </div> --}}
    {{-- </div> --}}

    <!-- Quantity -->
    <div class="form-group row">
        {!! Form::label('quantity', 'Quantity', ['class' => 'col-md-2 col-form-label']) !!}

        <div class="col-md-4">
            {!! Form::number('quantity', $consumableItem->quantity, ['class' => 'form-control']) !!}
            @error('quantity')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>

    <!-- Price -->
    <div class="form-group row">
        {!! Form::label('price', 'Price (LKR)', ['class' => 'col-md-2 col-form-label']) !!}

        <div class="col-md-4">
            {!! Form::number('price', $consumableItem->price, ['class' => 'form-control']) !!}
            @error('price')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>

    {{-- <!-- isavailable --> --}}
    {{-- <div class="form-group row"> --}}
    {{-- {!! Form::label('Available?', '', ['class' => 'col-md-2 col-form-label']) !!} --}}

    {{-- <div class="col-md-4 d-flex align-items-center"> --}}
    {{-- {!!Form::checkbox('isAvailable',1,  ($consumableItem->isAvailable)?true:false); !!} --}}
    {{-- @error('isAvailable') --}}
    {{-- <strong>{{ $message }}</strong> --}}
    {{-- @enderror --}}
    {{-- </div> --}}
    {{-- </div> --}}

    <div class="form-group row">
        {{-- {!! Form::label('isElectrical', 'Electrical?', ['class' => 'col-md-2 form-check-label']) !!} --}}

        {{-- <div class="col-md-4 d-flex align-items-center"> --}}
        {{-- {!!Form::checkbox('isElectrical',1,  ($consumableItem->isElectrical)?true:false); !!} --}}
        {{-- @error('isElectrical') --}}
        {{-- <strong>{{ $message }}</strong> --}}
        {{-- @enderror --}}
        {{-- </div> --}}

        {{-- <!-- Power Rating --> --}}
        {{-- {!! Form::label('powerRating', 'Power Rating (Watts)', ['class' => 'col-md-2 col-form-label']) !!} --}}

        {{-- <div class="col-md-4"> --}}
        {{-- {!! Form::number('powerRating', $consumableItem->powerRating, ['class'=>'form-control']) !!} --}}
        {{-- @error('powerRating') --}}
        {{-- <strong>{{ $message }}</strong> --}}
        {{-- @enderror --}}
        {{-- </div> --}}
    </div>
    {{-- FormFactor --}}
    <div class="form-group row">
        {!! Form::label('formFactor', 'Form factor', ['class' => 'col-md-2 col-form-label']) !!}

        <div class="col-md-4">
            {!! Form::text('formFactor', $consumableItem->formFactor, ['class' => 'form-control']) !!}
            @error('formFactor')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>

    {{-- datasheetURL --}}
    <div class="form-group row">
        {!! Form::label('datasheetURL', 'Datasheet URL', ['class' => 'col-md-2 col-form-label']) !!}

        <div class="col-md-4">
            {!! Form::text('datasheetURL', $consumableItem->datasheetURL, ['class' => 'form-control']) !!}
            @error('datasheetURL')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>
    {{-- <div class="form-group row"> --}}
    {{--  --}}{{-- voltageRating --}}
    {{-- {!! Form::label('voltageRating', 'Voltage Rating', ['class' => 'col-md-2 col-form-label']) !!} --}}

    {{-- <div class="col-md-4"> --}}
    {{-- {!! Form::text('voltageRating', $consumableItem->voltageRating, ['class'=>'form-control']) !!} --}}
    {{-- @error('voltageRating') --}}
    {{-- <strong>{{ $message }}</strong> --}}
    {{-- @enderror --}}

    {{-- </div> --}}

    {{-- </div> --}}

    <!-- Thumbnail Image -->
    <div class="form-group row">
        {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

        <div class="col-md-10">
            <img src="{{ $consumableItem->thumbURL() }}" alt="" width="64">
            {!! Form::file('thumb', ['accept' => '.jpeg,.png,.jpg,.gif,.svg']) !!} (Max: 2MB, use square
            image)
            @error('thumb')
                <strong>{{ $message }}</strong>
            @enderror
        </div>
    </div>

    </x-slot>
    <x-slot name="footer">
        {!! Form::submit('Update', ['class' => 'btn btn-primary float-right']) !!}
    </x-slot>

    </x-backend.card>
    {!! Form::close() !!}
    </div>
@endsection
