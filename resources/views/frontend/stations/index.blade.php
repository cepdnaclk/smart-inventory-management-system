@extends('frontend.layouts.app')

@section('title', __('Station Details'))

@section('content')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Stations</h3>

                @if($stations->count() != 0)
                    <div class="container pt-2">
                        <div class="row equal">
                            @foreach($stations as $station)
                                <div class="col-6 col-sm-3 col-md-2 p-1 d-flex">
                                    <div class="text-center card">

                                        <a class="text-decoration-none"
                                           href="{{ route('frontend.stations.station', $station) }}">
                                            <img class="img-fluid p-1 mx-auto" src="{{ $station->thumbURL() }}"
                                                 alt="{{ $station->stationName }}"/>
                                            <div class="p-0.5">
                                                <b>{{ $station->stationName }}</b>
                                                <br>
                                                <p>
                                                    @if($station->capacity > 1)
                                                        Capacity: 1-{{ $station->capacity}} students
                                                    @else
                                                        Capacity: 1 student
                                                    @endif
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- <div class="container pt-4">
                            {{ $stations->links() }}
                        </div> --}}

                        @elseif ($stations->count() == 0)
                            <p>No items listed under this category yet</p>
                        @else
                            {{-- No items available--}}
                        @endif

                    </div>
            </div>
        </div>
    </div>

@endsection 