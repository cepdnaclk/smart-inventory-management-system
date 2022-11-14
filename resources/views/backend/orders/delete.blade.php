@extends('backend.layouts.app')

@section('title', __('Order'))

@section('breadcrumb-links')
    @include('backend.orders.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Order : Delete | {{ $order->id  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>{{ $order->id  }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.orders.destroy', compact('order') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
