@extends('backend.layouts.app')

@section('title', __('Component Locations'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Component Locations
            </x-slot>
            <x-slot name="body">
                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                        </x-utils.alert">
                @endif
                <p> Change locations for <b>{{ $componentItem->title }}</b></p>

                <ul>
                    @foreach ($locations as $i => $loc)
                        @include('backend.partials.location-hierarchy-for-edit-location', [
                            'location' => $loc,
                            'itemModel' => $componentItem,
                        ])
                    @endforeach
                </ul>
                <br>
                <a href="{{ route('admin.component.items.show', $componentItem) }}" class="btn btn-primary">Back</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
