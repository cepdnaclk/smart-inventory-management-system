@component('mail::message')
 <h1>{{ $details['title'] }}</h1>

{{ $details['body'] }}


@component('mail::button', ['url' => "#"])
{{$details['otp']}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
