@component('mail::message')

 <h2>{{ $details['title'] }}</h2>


{{-- The body of your message. --}}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}


{{ config('app.name') }}
@endcomponent
