@extends('backend.layouts.app')

@section('title', __('Order'))

@section('breadcrumb-links')
    @include('backend.orders.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.orders.update',
                  compact('order')),
                  'method' => 'put',
                  'class' => 'container',
                  'files'=>true,
                  'enctype'=>'multipart/form-data'
      ]) !!}


        <x-backend.card>
            <x-slot name="header">
                Order : Edit | {{ $order->title  }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('ordered_date', 'Ordered date*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::date('ordered_date', $order->ordered_date , ['class'=>'form-control', 'required'=>true ]) !!}
                        @error('ordered_date')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    {!! Form::label('picked_date', 'Picked Date*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::date('picked_date', $order->picked_date , ['class'=>'form-control',  ]) !!}
                        @error('picked_date')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <!-- picked_date -->
                <div class="form-group row">
                    {!! Form::label('due_date_to_return', 'Due date to return*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::date('due_date_to_return',  $order->due_date_to_return, ['class'=>'form-control',  ]) !!}
                        @error('due_date_to_return')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- picked_date -->
                <div class="form-group row">
                    {!! Form::label('returned_date', 'Returned date*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::date('returned_date', $order->returned_date, ['class'=>'form-control', ]) !!}
                        @error('returned_date')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- picked_date -->
                <div class="form-group row">
                    {!! Form::label('status', 'Status*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-4">
                        {!! Form::select('status', $order::STATUS, null, ['class'=>'form-control', 'placeholder'=>'Please select','required'=>true ]) !!}
                        @error('status')
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
