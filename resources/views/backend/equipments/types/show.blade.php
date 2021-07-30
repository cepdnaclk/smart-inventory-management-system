@extends('backend.layouts.app')

@section('title', __('Equipment Types'))

@section('breadcrumb-links')
        @include('backend.equipments.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Types : Show  {{ $equipmentType->title  }}
            </x-slot>

            <x-slot name="body">

            </x-slot>
        </x-backend.card>
    </div>
@endsection
