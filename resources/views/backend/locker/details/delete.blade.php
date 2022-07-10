@extends('backend.layouts.app')

@section('title', __('Locker Details'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Locker Details : Delete | Locker - {{ $lockerDetail->id  }}
            </x-slot>

            <x-slot name="body">
                <p>Are you sure you want to delete
                    <strong><i>Locker - {{ $lockerDetail->id  }}</i></strong> ?
                </p>

                <div class="d-flex">
                    {!! Form::open(['url' => route('admin.locker.details.destroy', compact('lockerDetail') ), 'method' => 'delete', 'class' => 'container']) !!}

                    <a href="{{ route('admin.locker.details.index') }}" class="btn btn-light mr-2">Back</a>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
