@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            <h3>Under Construction</h3>
            <ul class="large list-unstyled pt-5">
                <li>
                    <a class="btn btn-lg btn-primary" href="{{ route('admin.equipment.index') }}">Equipment</a>
                </li>
            </ul>

        </x-slot>
    </x-backend.card>

@endsection
