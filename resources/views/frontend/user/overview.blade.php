@extends('frontend.layouts.app')

@section('title', __('Overview'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Overview')
                    </x-slot>

                    <x-slot name="body">
                        @lang('You are logged in!')
                        <br>

                        <div class="py-3">
                            This page is under development. However, you can access the following pages.
                            <ul>
                                <li><a class="mx-1" href="{{ route('frontend.user.account') }}">@lang('Manage Account')</a></li>
                                @if ($logged_in_user->isAdminAccess())
                                    <li><a class="mx-1" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @endif
                            </ul>
                        </div>
                    </x-slot>
                </x-frontend.card>
            </div>
            <!--col-md-10-->
        </div>
        <!--row-->
    </div>
    <!--container-->
@endsection
