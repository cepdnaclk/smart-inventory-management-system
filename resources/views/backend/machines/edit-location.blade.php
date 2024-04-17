@extends('backend.layouts.app')

@section('title', __('Machine Locations'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Machine Locations
            </x-slot>
            <x-slot name="body">
                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                <p> Change locations for <b>{{ $machines->title }}</b></p>

                <ul>
                    @foreach ($locations as $i => $loc)
                        @include('backend.partials.location-hierarchy-for-edit-location', [
                            'location' => $loc,
                            'itemModel' => $machines,
                        ])
                    @endforeach
                </ul>
                <br>
                <a href="{{ route('admin.machines.show', $machines) }}" class="btn btn-primary">Back</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
