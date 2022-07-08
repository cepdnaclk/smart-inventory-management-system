<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Stations;
use App\Http\Controllers\Controller;
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

        // $equipment = (Stations::with('equipment_items')->find($station))->equipment_items;
        

    //     return view('frontend.stations.station', compact('stations', 'equipment'));

    // }
 
}
