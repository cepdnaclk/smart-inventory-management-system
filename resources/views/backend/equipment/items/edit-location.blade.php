@extends('backend.layouts.app')

@section('title', __('Equipment Locations'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Locations
            </x-slot>
            <x-slot name="body">
               @for($i = 1; $i < count($locations)+1; $i++)
                    <div>
                        <span>
                        @livewire('locations-toggler', ['locationID' => $i, 'itemModel' => $equipmentItem])</span>
                        <span>
                        <p>{{ $locations[$i] }}</p>
                        </span>

                    </div>
                @endfor
            </x-slot>
        </x-backend.card>
    </div>
@endsection