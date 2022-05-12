@extends('backend.layouts.app')

@section('title', __('Fabrications'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Job Requests
            </x-slot>

            <x-slot name="body">
                <div class="container">

                    <ul>
                        <li>
                            <a class="text-decoration-none" href="{{ route('admin.jobs.create') }}">
                                Fabrication - initiate a new Job
                            </a>
                        </li>

                        <li>
                            <a class="text-decoration-none" href="{{ route('admin.jobs.techo.index') }}">
                                Fabrication - Technical Officer
                            </a>
                        </li>

                        <li>
                            <a class="text-decoration-none" href="{{ route('admin.jobs.supervisor.index') }}">
                                Fabrication - Supervisor
                            </a>
                        </li>
                    </ul>
                </div>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
