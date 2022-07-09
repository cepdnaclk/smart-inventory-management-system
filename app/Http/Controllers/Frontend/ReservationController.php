<?php

namespace App\Http\Controllers\frontend;

use DateTime;
use Carbon\Carbon;
use App\Models\Stations;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    

    public function index()
    {
        $userLoggedin = auth()->user();
        // dd($userLoggedin);
        $reservation = Reservation::where('user_id', $userLoggedin['id'])->get();
        return view('frontend.reservation.index', compact('reservation', 'userLoggedin'));
    }

    public function edit(Reservation $reservation)
    {

        // $dateOriginal = $reservation->start_date;
        // dd($dateOriginal);
        $stations = Stations::pluck('stationName', 'id');
        $station = Stations::find($reservation->station_id);
        return view('frontend.reservation.edit', compact('reservation', 'stations', 'station'));
    }

    public function show(Reservation $reservation)
    {
       return view('frontend.reservation.show', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {


        $dateOriginal = (new DateTime($reservation->start_date))->format('Y-m-d');

        // dd($dateOriginal);

        $userLoggedin = auth()->user();
        

        $data = request()->validate([
            'station_id' => 'numeric|required',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s',
            'E_numbers' => 'string|required'
        ]);

        $dateNew = (new DateTime($data['start_date']))->format('Y-m-d');

        $date1 = Carbon::createFromFormat('Y-m-d',$dateOriginal);
        $date2 = Carbon::createFromFormat('Y-m-d', $dateNew);

        $result = $date1->eq($date2);

        // dd($result);

        $start = new DateTime($request['start_date']);
        $end = new DateTime($request['end_date']);
        $diff = $start->diff($end);
        $minutes = ($diff->h*60) + ($diff->s/60) + ($diff->i) + ($diff->d*24*60) + ($diff->m*30*24*60) + ($diff->y*365*24*60);
       
        // See if the user has already made a reservation on that day for this station
        $bookings1 = Reservation::whereDate('start_date', $start)->where('user_id', $userLoggedin['id'])->where('station_id', $data['station_id'])->get();

        // dd(count($bookings1));

        $data = [
            'station_id' => $request['station_id'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'E_numbers' => $request['E_numbers'],
            'duration' => $minutes,
            
        ];

        if($data['duration'] > 240){
            return redirect()->route('frontend.reservation.index')->with('Error', 'Station was not updated! Reservation can not exceed 4 hours');           
        }elseif((count($bookings1) == 1) && $result){
            $reservation->update($data);
            return redirect()->route('frontend.reservation.index')->with('Success', 'Station was updated !');            
        }elseif((count($bookings1) == 0)){
            $reservation->update($data);
            return redirect()->route('frontend.reservation.index')->with('Success', 'Station was updated !'); 
        }elseif((count($bookings1) == 1) && !$result){
            return redirect()->route('frontend.reservation.index')->with('Error', 'Station was not updated! Can not make multiple reservations in one day');   
        }
        

    }

    

    
}
