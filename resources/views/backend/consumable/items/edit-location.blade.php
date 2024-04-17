@extends('backend.layouts.app')

@section('title', __('Consumable Locations'))

@section('breadcrumb-links')
    @include('backend.consumable.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Consumable Locations
            </x-slot>
            <x-slot name="body">
                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif
                <p> Change locations for <b>{{ $consumableItem->title }}</b></p>

                <ul>
                    @foreach ($locations as $i => $loc)
                        @include('backend.partials.location-hierarchy-for-edit-location', [
                            'location' => $loc,
                            'itemModel' => $consumableItem,
                        ])
                    @endforeach
                </ul>
                <br>
                <a href="{{ route('admin.consumable.items.show', $consumableItem) }}" class="btn btn-primary">Back</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
