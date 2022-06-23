<?php

namespace App\Http\Controllers;

use App\Models\ItemLocations;
use App\Models\Locations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Find the full location path by location ID.
     * @param int $id
     * @return array
     */
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

    /**
     * Find the full location path by eloquent model
     *
     * @param Model $item
     * @return array
     */
    public function getLocationOfItem(Model $item)
    {
        $locations_array = array();
//        find the item location id from the item_locations table
        $locationID = ItemLocations::where('item_id', $item->inventoryCode())->get();
        $flag = false;
        if ($locationID->count() > 0) {
            $locationID = $locationID[0]->location_id;
        } else {
            return $locations_array;
        }
        return $this->getFullLocationPathByLocationID($locationID);
    }

}
