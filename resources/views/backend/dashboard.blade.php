@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@push('after-styles')
    <style>

        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
        }

        .card-counter:hover {
            box-shadow: 4px 4px 20px #DADADA;
            transition: .3s linear all;
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .card-counter.danger {
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.success {
            background-color: #66bb6a;
            color: #FFF;
        }

        .card-counter.info {
            background-color: #26c6da;
            color: #FFF;
        }

        .card-counter.request {
            background-color: #581845;
            color: #FFF;
        }

        

        .card-counter i {
            font-size: 5em;
            opacity: 0.2;
        }

        .card-counter .count-numbers {
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 32px;
            display: block;
        }

        .card-counter .count-name {
            position: absolute;
            right: 35px;
            top: 65px;
            font-style: italic;
            text-transform: capitalize;
            opacity: 0.5;
            display: block;
            font-size: 18px;
        }
    </style>
@endpush

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('admin.equipment.items.index') }}">
                            <div class="card-counter primary">
                                <span class="count-numbers">{{ $equipmentCount }}</span>
                                <span class="count-name">Equipment ({{ $equipmentTypeCount }} types)</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('admin.component.items.index') }}">
                            <div class="card-counter danger">
                                <span class="count-numbers">{{ $componentCount }}</span>
                                <span class="count-name">Components ({{ $componentTypeCount }} types)</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        @if ($logged_in_user->hasAllAccess())
                            <a class="text-decoration-none" href="{{ route('admin.auth.user.index') }}">
                                @endif
                                <div class="card-counter success">
                                    <span class="count-numbers">{{ $userCount }}</span>
                                    <span class="count-name">Users</span>
                                </div>
                                @if ($logged_in_user->hasAllAccess())</a> @endif
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('admin.jobs.officer.index') }}">
                            <div class="card-counter info">
                                <span class="count-numbers">Fabrication</span>
                                <span class="count-name">Technical Officer</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('admin.jobs.supervisor.index') }}">
                            <div class="card-counter info">
                                <span class="count-numbers">Fabrication</span>
                                <span class="count-name">Supervisor</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('admin.orders.lecturer.index') }}">
                            <div class="card-counter request">
                                <span class="count-numbers">18</span>
                                <span class="count-name">Orders request</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-backend.card>
@endsection
