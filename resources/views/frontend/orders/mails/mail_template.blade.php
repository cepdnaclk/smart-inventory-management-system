@component('mail::message')
 <h2>{{ $details['title'] }}</h2>
<h4>{{ $details['body'] }}</h4>

{{ $details['body'] }}



@component('mail::table')
    | Component Item| Component Type| Quantity |
    | ------------- |:-------------:| --------:|
    @foreach($details['components'] as $component)
    |{{$component->title}}|{{$component->component_type['title'] }}|{{$component ->pivot->quantity}}|
    @endforeach
@endcomponent


@component('mail::button', ['url' => $details['url']])
CE Smart Inventory
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
