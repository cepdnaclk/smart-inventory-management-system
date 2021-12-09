@extends('backend.layouts.app')

@section('title', __('component'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Job Requests - Supervisor View
            </x-slot>

            <x-slot name="body">
                <a href="{{ route('admin.jobs.supervisor.show', 1) }}">Show Sample #1</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
