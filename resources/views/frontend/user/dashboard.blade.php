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
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        
                    </x-slot>

                    <x-slot name="body">
                        @lang('You are logged in!')
                        <br>
                        
                        <div>
                           <a href="{{ route('frontend.user.products') }}">Create a cart</a>     
                        </div>   
                    </x-slot>
                </x-frontend.card>

                
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->


    
    <div class="container py-4">
        <div class="row">

                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('frontend.user.account') }}">
                            <div class="card-counter info">
                                <span class="count-numbers">Account</span>
                                <span class="count-name">Details</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('frontend.user.products') }}">
                            <div class="card-counter request">
                                <span class="count-numbers">Components</span>
                                <span class="count-name">Reservation</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('frontend.user.cart') }}">
                            <div class="card-counter success">
                                <span class="count-numbers">Cart</span>
                                <span class="count-name">Reservation Details</span>
                            </div>
                        </a>
                    </div>


                    <div class="col-md-3">
                        <a class="text-decoration-none" href="{{ route('frontend.user.show.order') }}">
                            <div class="card-counter danger">
                                <span class="count-numbers">My Orders</span>
                                <span class="count-name">Details</span>
                            </div>
                        </a>
                    </div>

        </div>   
    </div>

    
@endsection
