@extends('backend.layouts.app')

@section('title', __('component'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Component
            </x-slot>

            <x-slot name="body">
                <a class="btn btn-secondary btn-150" href="{{ route('admin.component.items.index') }}">Items</a>
                <a class="btn btn-secondary btn-150" href="{{ route('admin.component.types.index') }}">Types</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
