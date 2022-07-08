@extends('frontend.layouts.app')

@section('title', $stations->stationName)

@push('after-styles')
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

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function refreshPage() {
            window.location.reload();
        }
    </script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // TODO: Change the color of the other users in different color like Gray
            // You can do it in the CalendarController
            // Guide: https://fullcalendar.io/docs/event-source-object

            // TODO: Only load the events from last week to the future. Otherwise this can be a huge list in someday
            var booking = @json($events);

            $('#calendar').fullCalendar({
                defaultView: 'agendaWeek',
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking,
                selectable: false,
                selectHelper: false,

                dayClick: function (date, jsEvent, view) {
                    if (view.name === 'month') {
                        $('#calendar').fullCalendar('gotoDate', date);
                        $('#calendar').fullCalendar('changeView', 'agendaDay');
                    }
                },

                eventRender: function eventRender(event, element, view) {
                    $("#calendar .fc-title").each(function (i) {
                        $(this).html($(this).text());
                    });
                },

                editable: false,
            });

        });

 
    </script>
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

                        <b><a href="{{ route('frontend.calendar.index', $stations->id) }}"

                              style="float:right; font-size: 18px; text-decoration: underline;">Make a Reservation</a></b>
                    </div>
                @endauth

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center mt-20">Current Reservations</h5>
                    <br>
    
                    <div class="col-md-8 offset-2 mt-20 mb-5">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection