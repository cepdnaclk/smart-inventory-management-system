@extends('backend.layouts.app')

@section('title', __('locker'))

@section('breadcrumb-links')
    @include('backend.locker.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Locker
            </x-slot>

            <x-slot name="body">
                <a class="btn btn-secondary btn-150" href="{{ route('admin.locker.details.index') }}">Details</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
