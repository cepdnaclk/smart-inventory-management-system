@extends('backend.layouts.app')

@section('title', __('Edit Orders'))




@section('content')
    <div>
        {!! Form::open(['url' => route('frontend.user.orders.update',
                   compact('order')),
                   'method' => 'put',
                   'class' => 'container',
                   'files'=>true,
                   'enctype'=>'multipart/form-data'
       ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Order : Edit {{ $order->id }}
            </x-slot>

            <x-slot name="body">
                <!-- Title -->
                <div class="form-group row">
                    {!! Form::label('title', 'Order ID', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                        {!! Form::text('title', $order->id, ['class'=>'form-control', 'required'=>true,'disabled' ]) !!}
                    </div>

                    @error('title')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="form-group row">
                    {!! Form::label('selectLecturer', 'Choose lecturer', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-2">
                     <select class="form-select is-invalid" id="selectLecturer" name="selectLecturer" aria-describedby="validationServer04Feedback" value={{$order->orderApprovals->lecturer->name}} required>
                        <option selected ="selected">{{$order->orderApprovals->lecturer->name}}</option>
                      
                        @foreach ( $lecturers as $lecturer)
                        @if (!($lecturer->isHOD())&& $lecturer->name!=$order->orderApprovals->lecturer->name)
                        <option>{{$lecturer->name}}</option>
                        @endif
                        
                        @endforeach
                        
                      </select>
                    </div>
                    @error('selectLecturer')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

                <!-- Parent Category -->
               

                <!-- Description -->
                <div class="form-group row">
                    {!! Form::label('description', 'Description*', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('description', $order->description, ['class'=>'form-control', 'rows'=>3, 'required'=>true ]) !!}
                    </div>

                    @error('description')
                    <strong>{{ $message }}</strong>
                    @enderror
                </div>

             
            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Save', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        {!! Form::close() !!}
    </div>
@endsection
