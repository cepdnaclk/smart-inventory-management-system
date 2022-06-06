@extends('backend.layouts.app')

@section('title', __('Consumable Types'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Consumable Types : Delete {{ $consumableType->title  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>{{ $consumableType->title  }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.consumable.types.destroy', compact('consumableType') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.consumable.types.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
