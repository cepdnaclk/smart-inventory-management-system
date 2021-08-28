@extends('backend.layouts.app')

@section('title', __('Component'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.component.items.update',
                  compact('componentItem')),
                  'method' => 'put',
                  'class' => 'container',
                  'files'=>true,
                  'enctype'=>'multipart/form-data'
      ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Component : Edit | {{ $componentItem->title  }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', $componentItem->title , ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('title')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Category -->
                <div class="form-group row">
                    {!! Form::label('component_type_id', 'Category*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('component_type_id', $types, $componentItem->component_type_id, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('component_type_id')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Brand -->
                    {!! Form::label('brand', 'Brand', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('brand', $componentItem->brand, ['class'=>'form-control']) !!}
                        @error('brand')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Product Code -->
                    {!! Form::label('productCode', 'Product Code', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('productCode', $componentItem->productCode, ['class'=>'form-control']) !!}
                        @error('productCode')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                

                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', $componentItem->description, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('description')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Specifications -->
                <div class="form-group row">
                    {!! Form::label('specifications', 'Specifications', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('specifications', $componentItem->specifications, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('specifications')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Usage Instructions -->
                <div class="form-group row">
                    {!! Form::label('instructions', 'Usage Instructions', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('instructions', $componentItem->instructions, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('instructions')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Dimensions -->
                <div class="form-group row">
                    {!! Form::label('size', 'Size', ['class' => 'col-sm-2 form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::select('size',['very small'=>'very small', 'small'=> 'small', 'medium'=> 'medium','regular'=>'regular', 'large'=>'large','very large'=> 'very large'] ,$componentItem->size) !!}
                        @error('size')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                    
                <!-- Price -->
                <div class="form-group row">
                    {!! Form::label('price', 'Price (LKR)', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('price', $componentItem->price, ['class'=>'form-control']) !!}
                        @error('price')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $componentItem->thumbURL() }}" alt="" width="64">
                        {!! Form::file('thumb', ["accept"=>".jpeg,.png,.jpg,.gif,.svg"]);  !!} (Max: 2MB, use square
                        image)
                        @error('thumb')
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
