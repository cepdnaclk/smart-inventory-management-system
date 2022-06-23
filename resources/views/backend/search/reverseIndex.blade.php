@extends('backend.layouts.app')

@section('title', __('Search'))

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Search by location
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

                @if (!empty($status))
                    <div class="alert alert-danger" role="alert">
                        {{ $status }}
                    </div>
                @endif
                {{ Form::open(array('route' => 'admin.search.reverse.results')) }}
                <div class="d-flex col-md-6 align-content-center">
                    {!! Form::select('location', $locations, null, ['class'=>'form-control', 'required'=>true, 'placeholder' => '']) !!}
                    <span class="p-1">
                    {!! Form::submit('Search') !!}
                    </span>
                </div>
                {{ Form::close() }}

            </x-slot>
        </x-backend.card>
    </div>
@endsection
