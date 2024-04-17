@extends('backend.layouts.app')

@section('title', __('Machines'))

@section('breadcrumb-links')
    @include('backend.machines.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Machines
            </x-slot>

            @if ($logged_in_user->hasInventoryAccess())
                <x-slot name="headerActions">
                    <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.machines.create')" :text="__('Create Machine')">
                    </x-utils.link>
                </x-slot>
            @endif

            <x-slot name="body">

                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                <livewire:backend.machines-table />
    
            </x-slot>
        </x-backend.card>
    </div>
@endsection
