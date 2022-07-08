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

                @auth
                    <div class="pt-3">
                        <b><a href="{{ route('user.calendar.index', $stations->id) }}"
                              style="float:right; font-size: 18px; text-decoration: underline;">Make a Reservation</a></b>
                    </div>
                @endauth

            </div>
        </div>
    </div>

@endsection