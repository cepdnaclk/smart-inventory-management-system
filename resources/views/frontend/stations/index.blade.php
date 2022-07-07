@extends('frontend.layouts.app')

@section('title', __('Station Details'))

@section('content')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Stations</h3>

                <div class="container">
                    <ul>
                        @foreach($stations as $station)
                            <ul>
                                <div class="col-md-4 col-sm-12 col-12 d-flex mb-4">
                                    @if( $station->thumb != null )
                                        <img src="{{ $station->thumbURL() }}"
                                        alt="{{ $station->stationName }}"
                                        class="img img-thumbnail img-fluid p-3 mx-auto">
                                    @else
                                        {{-- TODO: Add a default image --}}
                                        <span>[Not Available]</span>
                                    @endif

                                    <div class="col-md-8 col-sm-12 col-12 mb-4">
                                        <a href="{{ route('frontend.stations.station',$station->id ) }}">{{ $station->stationName  }}</a>
                                    </div>
                                </div>
                            </ul>
                        @endforeach
                    </ul>
                </div> 
            </div>
        </div>
    </div>

@endsection 