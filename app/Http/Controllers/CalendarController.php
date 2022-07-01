<?php
 
namespace App\Http\Controllers; 

use App\Models\Booking;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Session;
 
class CalendarController extends Controller
{
    
    public function index(){

        // Get the station model clicked
        $station = Session::get('station');

        // Get the model of the user logged in
        $userLoggedin = auth()->user();
        
        $events = array();

        // Get all the reservations for that particular station
        $bookings = Reservation::where('station_id', $station->id)->get();

        foreach($bookings as $booking){
                       

            $events[] = [
                'id' => $booking->id,
                'title' =>'Reservation made by '.$booking->email.'  for  '.$booking->E_numbers,
                'start' =>$booking->start_date,
                'end' =>$booking->end_date,
                'stationId' => $station->id,
                'auth' => $booking->email,
            ];
        }

        return view('calendar.index', ['events' => $events, 'station' => $station, 'userLoggedin' => $userLoggedin]);
    }

    public function store(Request $request){
        $station = Session::get('station');
        $userLoggedin = auth()->user();
        
        $request->validate([
            'title' => 'required|string'
        ]);

        $booking = Reservation::create([
            
            'email' => $userLoggedin['email'],
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'station_id' => $station->id,
            'E_numbers' => $request->title,
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
