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
                        <div>
                            <a href="{{ route('frontend.user.products') }}">Create a cart</a>
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
