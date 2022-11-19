@extends('backend.layouts.app')

@section('title', __('Equipment Locations'))

@section('breadcrumb-links')
    @include('backend.equipment.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Locations
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
                <p> Change locations for <b>{{ $equipmentItem->title }}</b></p>

                <ul>
                    @foreach($locations as $i => $loc)
                        @include('backend.partials.location-hierarchy-for-edit-location', ['location' => $loc , 'itemModel' => $equipmentItem])
                    @endforeach
                </ul>
                <br>
                <a href="{{route('admin.equipment.items.show',$equipmentItem)}}" class="btn btn-primary">Back</a>
            </x-slot>
        </x-backend.card>
    </div>
@endsection