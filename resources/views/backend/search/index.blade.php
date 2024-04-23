@extends('backend.layouts.app')

@section('title', __('Search'))


@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Search
            </x-slot>

            @if ($logged_in_user->hasAllAccess())
                <x-slot name="headerActions">

                </x-slot>
            @endif

            <x-slot name="body">

                @if (session('Success'))
                    <x-utils.alert type="success" class="header-message">
                        {{ session('Success') }}
                    </x-utils.alert>
                @endif

                @if (!empty($status))
                    <div class="alert alert-danger" role="alert">
                        {{ $status }}
                    </div>
                @endif

                <p>Search for Equipment, Components, Consumables, Machines and Raw Material</p>

                {{ Form::open(['route' => 'admin.search.results']) }}
                <div class="row g-3 align-items-center">
                    <div class="col-6">
                        {!! Form::text('keywords', '', ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-auto">
                        {!! Form::submit('Search', ['class' => 'btn btn-primary float-right btn-150']) !!}
                    </div>
                </div>
                {{ Form::close() }}

            </x-slot>
        </x-backend.card>
    </div>
@endsection
