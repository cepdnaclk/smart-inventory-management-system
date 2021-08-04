@extends('backend.layouts.app')

@section('title', __('equipment'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment
            </x-slot>

            <x-slot name="body">

                <a href="{{ route('admin.equipment.types.index') }}">Equipment Types</a>
                <br/>
                <br/>
                <a href="{{ route('admin.equipment.items.index') }}">Equipment</a>

            </x-slot>
        </x-backend.card>
    </div>
@endsection
