<li>
    @livewire('locations-toggler', ['locationID' => $location->id, 'locationTitle'=> $location->location, 'itemModel' =>
    $itemModel])
</li>
@if ($location->getChildrenLocations()->count() > 0)
    <ul>
        @foreach($location->getChildrenLocations() as $i => $loc)
            @include('backend.partials.location-hierarchy-for-edit-location', ['location' => $loc, 'itemModel' => $itemModel])
        @endforeach
    </ul>
@endif