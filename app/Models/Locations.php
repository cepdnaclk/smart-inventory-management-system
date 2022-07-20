<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Livewire\str;

class Locations extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the parent location
     */
    public function get_parent_location()
    {
        return $this->hasOne(Locations::class, "id", "parent_location");
    }

    // Get array of all locations in their full path form ( root > child 1 > child 2 > child 3  etc...)
    public static function getFullLocationStringFromPluck()
    {
        $locations = Locations::all();

        $IDandFullPathArray = array();
        foreach ($locations as $location) {
            $IDandFullPathArray[$location->id] = $location->getFullLocationAddress();
        }

        return $IDandFullPathArray;
    }

    // Get the location address
    public function getFullLocationAddress()
    {
        $item = $this;
        $location = $this->location;
        while (!($item->get_parent_location()->first() == NULL || $item->get_parent_location()->first()->id == 1)) {
            $item = $item->get_parent_location()->first();
            $location = $item->location . " > " . $location;
        }
        return $location;
    }

    // Get the collection of children of the current location object
    public function getChildrenLocations()
    {
        return Locations::where('parent_location', $this->id)->get();
    }

}
