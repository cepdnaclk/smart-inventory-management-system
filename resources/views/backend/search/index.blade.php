@extends('backend.layouts.app')

@section('title', __('Search'))

@section('breadcrumb-links')
    @include('backend.component.includes.breadcrumb-links')
@endsection

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
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    {{ Form::open(array('route' => 'admin.search.results')) }}
                       {!! Form::text('keywords');  !!}
                    {!! Form::submit('Search') !!}
                    {{ Form::close() }}

            </x-slot>
        </x-backend.card>
    </div>
@endsection
