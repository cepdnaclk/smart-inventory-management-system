@extends('backend.layouts.app')

@section('title', __('Equipment Types'))

@section('breadcrumb-links')
    @include('backend.equipments.includes.breadcrumb-links')
@endsection

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Equipment Types : Show {{ $equipmentType->title  }}
            </x-slot>

            <x-slot name="body">

                <table class="table">
                    <tr>
                        <td>Title</td>
                        <td>{{ $equipmentType->title }}</td>
                    </tr>
                    <tr>
                        <td>Subitle</td>
                        <td>{{ $equipmentType->subtitle }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $equipmentType->description }}</td>
                    </tr>
                    <tr>
                        <td>Thumbnail</td>
                        <td>{{ $equipmentType->thumb }}</td>
                    </tr>
                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
