@extends('backend.layouts.app')

@section('title', __('Station'))

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
