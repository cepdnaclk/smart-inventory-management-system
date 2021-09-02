@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            <h3>Under Construction</h3>
            <ul class="large list-unstyled pt-5 d-inline-flex ">
                <li class="px-2">
                    <a class="btn btn-lg btn-primary" href="{{ route('admin.equipment.index') }}">Equipment</a>

                </li>
                <li class="px-2">
                    <a class="btn btn-lg btn-primary" href="{{ route('admin.component.index') }}">Component</a>
                </li>
            </ul>

        </x-slot>
    </x-backend.card>

@endsection
