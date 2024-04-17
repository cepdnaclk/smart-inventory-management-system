@extends('backend.layouts.app')

@section('title', __('Machines'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Machines : Delete | {{ $machines->title  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>{{ $machines->title  }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.machines.destroy', compact('machines') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.machines.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
