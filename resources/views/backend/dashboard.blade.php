@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            <h3>Pages</h3>

            <ul>
                <li>
                    <a href="/admin/equipments">Equipments</a>
                </li>
            </ul>

        </x-slot>
    </x-backend.card>

    This is an experiment :-)

@endsection
