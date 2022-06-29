<?php

namespace App\Http\Controllers; 

use App\Models\Booking;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
 
class CalendarController extends Controller
{
    
    public function index(){
        $station = Session::get('station');
        
        $events = array();
        // $bookings = Booking::all();
        // foreach($bookings as $booking){
        //     $color = null;
        //     if($booking->title == 'Try'){
        //         $color = '#33C0FF';
                
        //     }
        //     $events[] = [
        //         'id' => $booking->id,
        //         'title' =>$booking->title,
        //         'start' =>$booking->start_date,
        //         'end' =>$booking->end_date,
        //         'color' => $color,
        //     ];
        // }

        $bookings = Reservation::where('station_id', $station->id)->get();

        // $bookings = Reservation::all();
        foreach($bookings as $booking){
            // $color = null;
            // if($booking->email == 'Try'){
            //     $color = '#33C0FF';
                
            // }
            $events[] = [
                'id' => $booking->id,
                'email' =>$booking->email,
                'start' =>$booking->start_date,
                'end' =>$booking->end_date,
                'stationId' => $station->id,
            ];
        }

        return view('calendar.index', ['events' => $events, 'station' => $station]);
    }

    public function store(Request $request){
        $station = Session::get('station');
        $request->validate([
            'title' => 'required|string'
        ]);

        $booking = Reservation::create([
            // 'title' => $request->title,
            // 'start_date' => $request->start_date,
            // 'end_date' => $request->end_date,
            'email' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'station_id' => $station->id,
            // 'station_id' => $request->id,
        ]);

        $color = null;

        if($booking->title == 'Try'){
            $color = '#33C0FF';
        }
        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start_date,
            'end' => $booking->end_date,
            'title' => $booking->title,
            'station_id' => $station->id,
            'color' => $color ? $color: '',

        ]);
    }

    public function update( Request $request, $id){
        
        $booking = Reservation::find($id);
        if(! $booking){
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

    public function destroy($id){
        $booking = Reservation::find($id);
        if(! $booking){
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        $booking->delete();
        return $id;
    }

    
}
