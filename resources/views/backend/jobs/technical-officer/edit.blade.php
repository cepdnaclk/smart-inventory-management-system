@extends('backend.layouts.app')

@section('title', __('Job Requests - Technical Officer View'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Fabrication Request by
                @if($jobRequests->student_info != null)
                    <b>{{ $jobRequests->student_info['name'] }}</b>
                @endif
            </x-slot>

            <x-slot name="body">

            </x-slot>
        </x-backend.card>
    </div>
@endsection
