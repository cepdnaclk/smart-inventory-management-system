@component('mail::message')
<u>Station Reservation</u>

{{ $reserver->name}} made a reservation

@component('mail::button', ['url' => route('frontend.stations.index')])
    View Station
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
