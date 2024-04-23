@extends('backend.layouts.app')

@section('title', __('Job Requests - Technical Officer View'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Job Requests - Technical Officer View
            </x-slot>

            <x-slot name="body">
                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                <div class="container table-responsive pt-3">
                    <livewire:backend.fabrications-tech-officer-table />
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
