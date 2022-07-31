@extends('backend.layouts.app')

@section('title', __('Station'))

@section('breadcrumb-links')
    @include('backend.station.includes.breadcrumb-links')
@endsection 

@section('content')
    <div>
        <x-backend.card>
            <x-slot name="header">
                Station : Show | {{ $station->stationName  }}
            </x-slot>

            <x-slot name="body">
                <div class="container pb-2 d-inline-flex">
                    <div class="d-flex">
                        <h4>{{ $station->stationName }}</h4>
                    </div>
                    <div class="d-flex px-0 mt-0 mb-0 ml-auto">
                        <div class="btn-group" role="group" aria-label="Modify Buttons">
                            <a href="{{ route('admin.station.edit', $station)}}"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil" stationName="Edit"></i>
                            </a>
                            <a href="{{ route('admin.station.delete', $station)}}"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash"
                               stationName="Delete"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table">

                    <tr>
                        <td>Description</td>
                        <td>{!! str_replace("\n", "<br>", $station->description) !!}</td>
                    </tr>

                    <tr>
                        <td>Capacity</td>
                        <td>{{ $station->capacity }}</td>
                    </tr>
                    

                    <tr>
                        <td>Thumbnail</td>
                        <td>
                            @if( $station->thumb != null )
                                <img src="{{ $station->thumbURL() }}" alt="{{ $station->stationName }}"
                                     class="img img-thumbnail">
                            @else
                                <span>[Not Available]</span>
                            @endif
                        </td>
                    </tr>

                </table>
            </x-slot>
        </x-backend.card>
    </div>
@endsection
