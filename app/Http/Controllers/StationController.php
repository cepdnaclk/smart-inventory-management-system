<?php

namespace App\Http\Controllers;

use App\Models\Stations;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index()
    {
        
        $stations = Stations::all();
        return view('frontend.stations.index', compact('stations'));

    }
}
