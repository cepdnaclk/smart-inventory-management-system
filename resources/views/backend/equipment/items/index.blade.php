@extends('backend.layouts.app')

@section('title', __('Equipment'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment
            </x-slot>

            @if ($logged_in_user->hasInventoryAccess())
                <x-slot name="headerActions">
                    <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.equipment.items.create')" :text="__('Create Equipment')">
                    </x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">

                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                <livewire:backend.equipment-item-table />
            </x-slot>

        </x-backend.card>
    </div>
@endsection
