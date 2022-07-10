@extends('backend.layouts.app')

@section('title', __('Send Mail'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        {!! Form::open(['url' => route('admin.orders.officer.mail'),
                   'method' => 'post',
                   'class' => 'container',
                   'files'=>true,
                   'enctype'=>'multipart/form-data'
       ]) !!}

        <x-backend.card>
            <x-slot name="header">
                Mail Detail : Order ID - {{ $approvedOrder->id }}
            </x-slot>

            <x-slot name="body">

                <!-- Email input-->
                <div class="form-group row">
                    {!! Form::label('email', 'Email To', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::email('email', $approvedOrder->user->email, ['class'=>'form-control']) !!} {{--,'readonly'--}}
                        @error('email')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <!-- Email body -->
                <div class="form-group row">
                    {!! Form::label('body', 'Email Body', ['class' => 'col-md-2 col-form-label']) !!}

                    <div class="col-md-10">
                        {!! Form::textarea('body','', ['class'=>'form-control', 'rows'=>3, 'required'=>true, 'placeholder'=>"Please enter your email body here..." ]) !!}
                        @error('body')
                        <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

            </x-slot>

            <x-slot name="footer">
                {!! Form::submit('Send', ['class'=>'btn btn-primary float-right']) !!}
            </x-slot>

        </x-backend.card>

        {!! Form::close() !!}
    </div>
@endsection