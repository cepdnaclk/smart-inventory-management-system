@extends('backend.layouts.app')

@section('title', __('Job Requests - Supervisor View'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Job Requests - Supervisor View
            </x-slot>

            <x-slot name="body">
                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                <div class="container table-responsive pt-3">
                    <h4 class="pb-3">Waiting for Supervisor Approval</h4>
                    <livewire:backend.fabrications-waiting-for-supervisor-approval-table />
                </div>


                <div class="container table-responsive pt-5">
                    <h4 class="pb-3">Pending Fabrication</h4>
                    <livewire:backend.fabrications-supervisor-pending-fabrication-table />
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
