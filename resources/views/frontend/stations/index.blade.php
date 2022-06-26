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
                    
                                <li>
                                    <a href="/stations/{{ $station->id }}">{{ $station->stationName  }}</a>
                                </li>
                        @endforeach
                    </ul>
                </div>

                
            </div>
        </div>
    </div>
    
@endsection 