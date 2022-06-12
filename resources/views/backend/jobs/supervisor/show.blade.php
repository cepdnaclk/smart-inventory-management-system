@extends('backend.layouts.app')

@section('title', __('Job Requests - Supervisor View'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Fabrication Request by .......
            </x-slot>

            <x-slot name="body">

            </x-slot>
        </x-backend.card>
    </div>
@endsection
