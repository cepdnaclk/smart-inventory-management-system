@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">

            <ul class="large">
                <li>
                    <a href="{{ route('admin.equipment.index') }}">equipment</a>
                </li>
            </ul>

        </x-slot>
    </x-backend.card>

    This is an experiment :-)

@endsection
