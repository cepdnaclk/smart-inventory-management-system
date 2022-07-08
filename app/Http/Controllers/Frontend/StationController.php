<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Stations;
use App\Models\Reservation;
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

        // Get the model of the user logged in
        $userLoggedin = auth()->user();
        $events = array();

        // Get all the reservations for that particular station
        $bookings = Reservation::where('station_id', $stations->id)->where('start_date', '>', Carbon::now()->subDays(8))->get();

        $color = null;

        foreach ($bookings as $booking) {

            if($booking->user_id != $userLoggedin['id']){
                $color = '#435258';
            }else{
                $color = '#3E9CC2';
            }
            $userVar = User::find($booking->user_id);
            $events[] = [
                'id' => $booking->id,
                'title' => 'Reservation made by ' . $userVar->email . '  for  ' . $booking->E_numbers,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'stationId' => $station->id,
                'auth' => $booking->user_id,
                'color' => $color,
            ];
        }

        //return view('frontend.calendar.index', ['events' => $events, 'station' => $station, 'userLoggedin' => $userLoggedin]);
        
        return view('frontend.stations.station', compact('stations', 'events'));
    }

     
}
