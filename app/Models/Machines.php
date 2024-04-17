<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Machines extends Model implements Searchable
{
    use HasFactory;

    protected $guarded = [];

    // reverse search depends on this. Change SearchController.php if you're changing this
    public function inventoryCode()
    {
        return sprintf("MC/%03d", $this->id);
    }

    // Return the relative URL of the thumbnail
    public function thumbURL()
    {
        if ($this->thumb != null) return '/img/machines/' . $this->thumb;
        return null;
    }

    // Types of the machines
    public static function types()
    {
        return [
            'CNC' => 'CNC Milling Machine',
            'FDM_3D_PRINTER' => '3D Printer (FDM)',
            'LASER_CUTTER' => 'Laser Cutter',
            'PCB_MILL' => 'PCB Milling Machine'
        ];
    }

    // Machine availability options
    public static function availabilityOptions()
    {
        return [
            'AVAILABLE' => 'Available',
            'NOT_AVAILABLE' => 'Not Available',
            'CONDITIONALLY_AVAILABLE' => 'Conditionally Available'];
    }

    // Lifespan of the machine in hour and minute format
    public function lifespanString()
    {
        return (intdiv($this->lifespan, 60)) . " hours " . ($this->lifespan % 60) . " minutes";
    }

    public function getLocations()
    {
        return ItemLocations::where('item_id', $this->inventoryCode())->get() || 1;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('admin.machines.show', $this);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    //get location
    public function getLocation(){
        $locationID = ItemLocations::where('item_id',$this->inventoryCode())->get()->first()->location_id;
        if ($locationID == null){
            return null;
        } else {
            $count = $this->getNumberOfLocationsForItem($this);
            $locationStrings = array();
            for ($i=0; $i < $count; $i++) { 
                $locationStrings[] = $this->getFullLocationPathAsString($this, $i);
            }
            return $locationStrings;
        }
    }

    public function getFullLocationPathByLocationID(int $id){
        $locationID = $id;
        $locations_array = array();
        while (true) {
            $thisLocation = Locations::where('id', $locationID)->get()[0];
            $locations_array[] = $thisLocation->location;
            $locationID = $thisLocation->parent_location;

            if ($locationID == null) break;
        }

        return $locations_array;
    }

    public function getFullLocationPathAsString(Model $item, int $index){
        $location_array = $this->getFullLocationPathAsArray($item,$index);
        return implode(' > ', array_reverse($location_array));
    }

    public function getFullLocationPathAsArray(Model $item, int $index)
    {
        $locations_array = array();
//        find the item location id from the item_locations table
        $locationID = ItemLocations::where('item_id', $item->inventoryCode())->get();
        if ($locationID->count() > 0) {
            $locationID = $locationID[$index]->location_id;
        } else {
            return $locations_array;
        }
        return $this->getFullLocationPathByLocationID($locationID);
    }

     public function getNumberOfLocationsForItem(Model $item){
        $locationID = ItemLocations::where('item_id', $item->inventoryCode())->get();
        return $locationID->count();
    }

}
