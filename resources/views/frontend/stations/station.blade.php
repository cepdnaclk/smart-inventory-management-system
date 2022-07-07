@extends('frontend.layouts.app')

@section('title', $stations->stationName)

@push('after-styles')

    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"--}}
    {{--          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>

    <style>
        td {
            padding: 1px 12px 1px 0;
        }

        .fc-event {
            font-size: 14px;
            border-radius: 1px !important;
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

                @auth
                    <div class="pt-3">
                        <b><a href="{{ route('user.calendar.index') }}"
                              style="float:right; font-size: 18px; text-decoration: underline;">Make Reservation</a></b>
                    </div>
                @endauth

            </div>
        </div>

        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center mt-5">Schedule Reservation - {{ $stations->stationName }}</h3>
                        <br>

                        <div class="col-md-11 offset-1 mt-5 mb-5">
                            <div id="calendar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection