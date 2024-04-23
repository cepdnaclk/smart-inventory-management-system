<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Stations;
use App\Models\Reservation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Domains\Auth\Models\User;

class StationController extends Controller
{
    // Home page listing all station
    public function index()
    {
        $stations = Stations::all();
        return view('frontend.stations.index', compact('stations'));
    }

    // Listing for the side bar
    public function sidebarIndex(){
        $stations = Stations::all();
        return view('backend.station.user.index', compact('stations'));
    }

    // Station view from sidebar
    public function show(Stations $station)
    {
        return view('backend.station.user.show', compact('station'));
    }


    //Station details page
    public function viewStation($station)
    {
        
        $stations = Stations::find($station);
        Session::put('station', $stations);
        $events = array();

        // Get all the reservations for that particular station
        $bookings = Reservation::where('station_id', $stations->id)->where('start_date', '>', Carbon::now()->subDays(8))->get();

        $color = null;

        foreach ($bookings as $booking) {

            $userVar = User::find($booking->user_id);
            $events[] = [
                'id' => $booking->id,
                'title' => 'Reservation made by ' . $userVar->email . '  for  ' . $booking->E_numbers,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'stationId' => $stations->id,
                'auth' => $booking->user_id,
                'color' => $color,
            ];
        }

        
        return view('frontend.stations.station', compact('stations', 'events'));
    }

     
}
