<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Stations;
use Illuminate\Http\Request;
use App\Models\EquipmentItem;
use App\Models\StationEquipment;
use App\Http\Controllers\Controller;
use App\Models\EquipmentItemStation;
use Illuminate\Support\Facades\Session;

class StationController extends Controller
{
    // Home page listing all station
    public function index()
    {
        $stations = Stations::all();
        return view('frontend.stations.index', compact('stations'));
    }

    //Station details page
    public function viewStation($station)
    {
        $stations = Stations::find($station);
        Session::put('station', $stations);
        
        return view('frontend.stations.station', compact('stations'));
    }

}
