<?php

namespace App\Http\Controllers;

use App\Models\ItemLocations;

class LocationAPI extends Controller
{
    public function index()
    {
//        $time_start = microtime(true);

        $locations = ItemLocations::all();
        foreach ($locations as $key => $value) {
//      foreach in locations to get the full location path
            $full_location_path_array = $this->getFullLocationPathByLocationID($value->location_id);
            $locations[$key]->full_location_path = implode(' > ', array_reverse($full_location_path_array));

//            get item
            $item_model = $value->get_item();
            if ($item_model != null) {
                $locations[$key]->model = $value->get_item();

//                item class name for identifying if its equipment, consumable etc...
                $full_class_name = get_class($item_model);
                $class_name = substr($full_class_name, strrpos($full_class_name, '\\') + 1);
                $locations[$key]->item_class_name = $class_name;

            } else {
//                the seeder is not consistent with other details. ItemLocations table has records that the equipment table doesn't have
                unset($locations[$key]);
            }


        }
//        $time_end = microtime(true);
//        $execution_time = ($time_end - $time_start);
//        $locations['time'] = $execution_time;
        return $locations;
    }
}
