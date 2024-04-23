@extends('backend.layouts.app')

@section('title', __('Raw Materials'))

@section('breadcrumb-links')
    @include('backend.raw_materials.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.raw_materials.update',
                  compact('rawMaterials')),
                  'method' => 'put',
                  'class' => 'container',
                  'files'=>true,
                  'enctype'=>'multipart/form-data'
      ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Raw Materials : Edit | {{ $rawMaterials->title  }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Title*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::text('title', $rawMaterials->title , ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('title')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Color -->
                <div class="form-group row">
                    {!! Form::label('color', 'Color', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('color', $rawMaterials->color, ['class'=>'form-control']) !!}
                        @error('color')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', $rawMaterials->description, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('description')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Specifications -->
                <div class="form-group row">
                    {!! Form::label('specifications', 'Specifications', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('specifications', $rawMaterials->specifications, ['class'=>'form-control', 'rows'=>3 ]) !!}
                        @error('specifications')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Quantity -->
                    {!! Form::label('quantity', 'Quantity', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::number('quantity', $rawMaterials->quantity, ['class'=>'form-control']) !!}
                        @error('quantity')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>

                    <!-- Unit -->
                    {!! Form::label('unit', 'Unit', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::text('unit', $rawMaterials->unit, ['class'=>'form-control']) !!}
                        @error('unit')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Availability -->
                <div class="form-group row">
                    {!! Form::label('availability', 'Availability*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('availability',
                                $rawMaterials->availabilityOptions(),
                                $rawMaterials->availability, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                        @error('availability')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group row">
                    {!! Form::label('thumb', 'Thumbnail', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        <img src="{{ $rawMaterials->thumbURL() }}" alt="" width="64">
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
