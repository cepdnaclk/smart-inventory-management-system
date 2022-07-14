@extends('backend.layouts.app')

@section('title', __('Order Requests'))

@section('breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Order Requests For Technical Officer
            </x-slot>

            <x-slot name="body">
                @if (session('Success'))
                    <div class="alert alert-success">
                        {{ session('Success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <a class="btn btn-secondary btn-150" href="{{ route('admin.orders.officer.approved.index') }}">Approved <br> Orders</a>
                <a class="btn btn-secondary btn-150" href="{{ route('admin.orders.officer.submitted.index') }}">Submitted <br> Orders</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
