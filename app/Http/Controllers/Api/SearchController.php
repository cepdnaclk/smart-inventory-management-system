<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ComponentItemController;
use App\Http\Controllers\Api\ComponentTypeController;
use App\Http\Controllers\Api\EquipmentItemController;
use App\Http\Controllers\Api\EquipmentTypeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function search(Request $request){
        

        $citems = (new ComponentItemController)->search($request);
        $ctypes = (new ComponentTypeController)->search($request);
        $eitems = (new EquipmentItemController)->search($request);
        $etypes = (new EquipmentTypeController)->search($request);
    
        // search in the title and body columns from the posts table
        $result = array_merge(["Component Items"=>$citems],
                              ["Component Types"=>$ctypes],
                              ["Equipment Items"=>$eitems],
                              ["Equipment Types"=>$etypes]);
    
        // Return the search view with the resluts compacted
        return $result;
    }
    
}
