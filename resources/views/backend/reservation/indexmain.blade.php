@extends('backend.layouts.app')

@section('title', __('Reservation'))

@section('breadcrumb-links')
    @include('backend.reservation.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Reservation
            </x-slot>

            <x-slot name="body">
                <a class="btn btn-secondary btn-150 mb-2" href="{{ route('admin.reservation.index') }}">Reservations - Maintainer</a>
                <br/>
                <a class="btn btn-secondary btn-150 mb-2" href="{{ route('frontend.reservation.index') }}">Reservations - User</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection


