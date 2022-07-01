@extends('frontend.layouts.app')

@section('title', $stations->stationName)

@push('after-styles')
    <style>
        td {
        padding: 1px 12px 1px 0;
        }
    </style>
@endpush

@section('content')

    <div class="container py-4">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12 d-flex mb-4">
                @if( $stations->thumb != null )
                    <img src="{{ $stations->thumbURL() }}"
                         alt="{{ $stations->stationName }}"
                         class="img img-thumbnail img-fluid p-3 mx-auto">
                @else
                    {{-- TODO: Add a default image --}}
                    <span>[Not Available]</span>
                @endif

            </div>
            <div class="col-md-8 col-sm-12 col-12 mb-4">

                <h3>{{ $stations->stationName }} <br>      
                    <hr>    
                </h3>

                <div>
                    <table>
                        
                        <tr>
                            <td>Capacity</td>
                            <td>
                                @if($stations->capacity > 1)
                                    : <b>1-{{ $stations->capacity }} students per table</b>
                                @else
                                    : <b>{{ $stations->capacity }} student per table</b>
                                @endif

                            </td>
                        </tr>
                        
                    </table>
                </div>

                @if($stations->description !== null)
                    <div class="pt-3">
                        <u>Description</u>
                        <div class="pl-3">
                            {!! str_replace("\n", "<br>", $stations->description) !!}
                        </div>
                    </div>
                @endif

                <div class="pt-3">
                    <u>Tools and Accessories</u>
                    <ul>
                        @foreach($equipment as $eq)
                            <li>
                            <a href="{{ route('frontend.equipment.item', $eq) }}">{{ $eq->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
<<<<<<< HEAD
                <div class="pt-3">
                    <b><a href="calendar/index" style="float:right; font-size: 18px;" >Make Reservation</a></b>
                </div>
=======

                @auth
                <div class="pt-3">
                    <b><a href="calendar/index" style="float:right; font-size: 18px; text-decoration: underline;" >Make Reservation</a></b>
                </div>
                @endauth

                

                
>>>>>>> a1f35f9640f7263bb98abf9d7e455b3d57fd6f36
            </div>
        </div>
    </div>
    
@endsection