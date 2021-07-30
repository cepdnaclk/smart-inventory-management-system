@extends('backend.layouts.app')

@section('title', __('Equipments'))

@section('breadcrumb-links')
        @include('backend.equipments.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipments : Edit | {{ $equipmentItem->title  }}
            </x-slot>

            <x-slot name="body">

            </x-slot>
        </x-backend.card>
    </div>
@endsection
