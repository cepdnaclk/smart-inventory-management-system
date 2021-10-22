@extends('backend.layouts.app')

@section('title', __('component'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Job Requests
            </x-slot>

            <x-slot name="body">

            </x-slot>
        </x-backend.card>
    </div>
@endsection
