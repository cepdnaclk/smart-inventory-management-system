<li>
    @livewire('locations-toggler', ['locationID' => $location->id, 'locationTitle'=> $location->location, 'itemModel' =>
    $equipmentItem])
</li>
@if ($location->getChildrenLocations()->count() > 0)
    <ul>
        @foreach($location->getChildrenLocations() as $i => $loc)
            @include('backend.partials.location-hierarchy-for-edit-location', ['location' => $loc, 'equipmentItem' => $equipmentItem])
        @endforeach
    </ul>
@endif