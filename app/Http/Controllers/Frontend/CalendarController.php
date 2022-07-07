<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Reservation;
use App\Models\Stations;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CalendarController extends Controller
{
    public function index(Stations $station)
    {
        // Get the model of the user logged in
        $userLoggedin = auth()->user();
        $events = array();

        // $today = Carbon::now()->subDays(7);
        // // $agoDate = $currentDate->subDays($currentDate->dayOfWeek)->subWeek();
        // $weekStartDate = Carbon::now()->startOfWeek()->endOfWeek()->startOfWeek()->format('Y-m-d H:i:s');
        // dd($today);

        // Get all the reservations for that particular station
        $bookings = Reservation::where('station_id', $station->id)->where('start_date' , '>', Carbon::now()->subDays(8))->get();

        
        foreach ($bookings as $booking) {

            $color = null;

            if($booking->user_id == $userLoggedin['id']){
                $color = '#3C89AB';
            }else{
                $color = '#435258';
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

        return view('frontend.calendar.index', ['events' => $events, 'station' => $station, 'userLoggedin' => $userLoggedin]);
    }

    public function store(Request $request)
    {

        $station = Session::get('station');
        $userLoggedin = auth()->user();


        $request->validate([
            'title' => 'required|string'
        ]);

        $date = $request->begin;

        // See if the user has already made a reservation on that day
        $bookings1 = Reservation::whereDate('start_date', $date)->where('user_id', $userLoggedin['id'])->get();

        // If the user has not made a reservation before
        if ($bookings1->isEmpty()) {

            $booking = Reservation::create([

                'user_id' => $userLoggedin['id'],
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'station_id' => $station->id,
                'E_numbers' => $request->title,
                'duration' => $request->m,

            ]);

            // $color = null;

            // if ($booking->title == 'Try') {
            //     $color = '#33C0FF';
            // }

            return response()->json([
                'id' => $booking->id,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'title' => $booking->title,
                'station_id' => $station->id,
                // 'color' => $color ? $color : '',

            ]);

            // return redirect()->route('user.calendar.index');

        } else {
            // Print message
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 403);
        }

        // $booking = Reservation::create([

        //     'email' => $userLoggedin['email'],
        //     'start_date' => $request->start_date,
        //     'end_date' => $request->end_date,
        //     'station_id' => $station->id,
        //     'E_numbers' => $request->title,
        // ]);


        // $color = null;

        // if($booking->title == 'Try'){
        //     $color = '#33C0FF';
        // }
        // return response()->json([
        //     'id' => $booking->id,
        //     'start' => $booking->start_date,
        //     'end' => $booking->end_date,
        //     'title' => $booking->title,
        //     'station_id' => $station->id,
        //     'color' => $color ? $color: '',

        // ]);
    }

    public function update(Request $request, $id)
    {
        $booking = Reservation::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');

    }

    public function destroy($id)
    {
        $booking = Reservation::find($id);


        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        $booking->delete();

        return $id;
    }
}
