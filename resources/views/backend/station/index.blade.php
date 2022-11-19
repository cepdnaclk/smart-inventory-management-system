@extends('backend.layouts.app')

@section('title', __('Station'))

@section('breadcrumb-links')
    @include('backend.station.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Station
            </x-slot>

            @if ($logged_in_user->hasInventoryAccess())
                <x-slot name="headerActions">
                    <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.station.create')" :text="__('Create Station')">
                    </x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">

                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <livewire:backend.stations-table />
            </x-slot>
        </x-backend.card>
    </div>
@endsection
