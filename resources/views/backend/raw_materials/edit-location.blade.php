@extends('backend.layouts.app')

@section('title', __('Raw Material Locations'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Raw Material Locations
            </x-slot>
            <x-slot name="body">
                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif
                <p> Change locations for <b>{{ $rawMaterials->title }}</b></p>

                <ul>
                    @foreach ($locations as $i => $loc)
                        @include('backend.partials.location-hierarchy-for-edit-location', [
                            'location' => $loc,
                            'itemModel' => $rawMaterials,
                        ])
                    @endforeach
                </ul>
                <br>
                <a href="{{ route('admin.raw_materials.show', $rawMaterials) }}" class="btn btn-primary">Back</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
