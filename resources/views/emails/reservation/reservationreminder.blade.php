@component('mail::message')
<u>Station Reservation</u>

Your reservation is about to end. Please be kind enough to upload an image after using the station.

Station: <b>{{ $station->stationName}} </b><br>
Date and Time: <b>{{explode(' ',$booking->start_date)[0]}} 
    ({{explode(' ',$booking->start_date)[1]}}-{{explode(' ',$booking->end_date)[1]}}) </b>

@component('mail::button', ['url' => route('frontend.stations.station', $station->id)])
    View Reservation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
