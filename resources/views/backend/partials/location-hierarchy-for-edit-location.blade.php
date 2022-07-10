<li>
    @livewire('locations-toggler', ['locationID' => $location->id, 'locationTitle'=> $location->location, 'itemModel' =>
    $equipmentItem])
</li>
@if ($location->children->count() > 0)
    <ul>
        @foreach($location->children as $i => $loc)
            @include('backend.partials.location-hierarchy-for-edit-location', ['location' => $loc, 'equipmentItem' => $equipmentItem])
        @endforeach
    </ul>
@endif