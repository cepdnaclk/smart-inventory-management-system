@extends('backend.layouts.app')

@section('title', __('Equipment Types'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Types : Delete {{ $equipmentType->title  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>{{ $equipmentType->title  }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.equipment.types.destroy', compact('equipmentType') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.equipment.types.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
