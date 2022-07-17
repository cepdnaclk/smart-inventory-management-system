<?php

namespace App\Http\Controllers\Frontend;

use DateTime;
use Carbon\Carbon;
use App\Models\Stations;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\StationReservationMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CalendarController extends Controller
{
    public function index(Stations $station)
    {
        // Get the model of the user logged in
        $userLoggedin = auth()->user();
        $events = array();

        // Get all the reservations for that particular station
        $bookings = Reservation::where('station_id', $station->id)->where('start_date', '>', Carbon::now()->subDays(8))->get();

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

        $today = date('Y-m-d');

        return view('frontend.calendar.index', ['events' => $events, 'station' => $station, 'userLoggedin' => $userLoggedin, 'today' => $today]);
    }

    public function store(Request $request)
    {

        $station = Session::get('station');
        $userLoggedin = auth()->user();

        $stringLength = Str::length($request['title']);
       
        

        /********************Enumber check *****************************/
        $naught = 0;
        $first = 1;
        $second = 4;
        $third = 8;
        $space = 9;
        $flag1 = true;

        for($index = 0; $index < $stringLength; $index++){
            if($index == 0 || $index == $naught + 10){
                $naught = $index;
                if(($request['title'][$index] != 'E')){
                    $flag1 = false;
                }             
            }elseif(($index == 1 || $index == $first+10)){
                $first = $index;
                if(($request['title'][$index] != '/')){
                    $flag1 = false;
                }  
            }elseif(($index == 4 || $index == $second+10)){
                $second = $index;
                if(($request['title'][$index] != '/')){
                    $flag1 = false;
                }
            }elseif(($index == 8 || $index == $third+10)){
                $third = $index;
                if(($request['title'][$index] != ',')){
                    $flag1 = false;
                }
            }elseif(($index == 9 || $index == $space+10)){
                $space = $index;
                if(($request['title'][$index] != ' ')){
                    $flag1 = false;
                }
            }else{
                if(!(is_numeric($request['title'][$index]))){
                    $flag1 = false;
                }
            }

        }

        $naught = 0;
        $first = 1;
        $second = 4;
        $third = 8;
        $flag = true;

        if(!$flag1){
            for($index = 0; $index < $stringLength; $index++){
                if($index == 0 || $index == $naught + 9){
                    $naught = $index;
                    if(($request['title'][$index] != 'E')){
                        $flag = false;
                    }             
                }elseif(($index == 1 || $index == $first+9)){
                    $first = $index;
                    if(($request['title'][$index] != '/')){
                        $flag = false;
                    }  
                }elseif(($index == 4 || $index == $second+9)){
                    $second = $index;
                    if(($request['title'][$index] != '/')){
                        $flag = false;
                    }
                }elseif(($index == 8 || $index == $third+9)){
                    $third = $index;
                    if(($request['title'][$index] != ',')){
                        $flag = false;
                    }
                }else{
                    if(!(is_numeric($request['title'][$index]))){
                        $flag = false;
                    }
                }
    
            }
        }


        /********************Enumber check *****************************/

        if(!$flag){
            $request['title'] = null;
        }

        $request->validate([
            // 'title' => 'required|string'
            'title' => 'required|regex:/^[E/\d{2}/\d{3}]+$',
        ]);


        $date = $request->begin;

        // See if the user has already made a reservation on that day for this station
        $bookings1 = Reservation::whereDate('start_date', $date)->where('user_id', $userLoggedin['id'])->where('station_id', $station->id)->get();

        
        // $bookings1 = Reservation::whereDate('start_date', $date)->where('user_id', $userLoggedin['id'])->get();

        // If the user has not made a reservation before
        if ($bookings1->isEmpty() && $flag) {

            $booking = Reservation::create([

                'user_id' => $userLoggedin['id'],
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'station_id' => $station->id,
                'E_numbers' => $request->title,
                'duration' => $request->m,

            ]);

            $color = null;

            if ($booking->title == 'Try') {
                $color = '#33C0FF';
            }

            //***********mails****************

            // $enums = explode(',',$request->title);

            // foreach ($enums as $enum){
            
            //     //get enumber
            //     $enum1=explode('/',$enum);
            //     $batch=$enum1[1];
            //     $regnum=$enum1[2];

            //     //set api url
            //     $apiurl = 'https://api.ce.pdn.ac.lk/people/v1/students/E'.''.$batch.'/'.$regnum.'/';

            //     //api call
            //     $response = Http::withoutVerifying()
            //         ->get($apiurl);
                
            //     //extract email address
            //     $email=($response['emails']['faculty']['name'].'@'.$response['emails']['faculty']['domain']);

            //     //get user
            //     $user = auth()->user();
                
            //     //send mail
            //     Mail::to($email)
            //         ->send(new StationReservationMail(auth()->user(), $station, $booking));
            // }

            //**********mails****************

            return response()->json([
                'id' => $booking->id,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
                'title' => $booking->title,
                'station_id' => $station->id,
                'color' => $color ? $color : '',

            ]);

            // return Redirect::back()->response()->json([
            //     'id' => $booking->id,
            //     'start' => $booking->start_date,
            //     'end' => $booking->end_date,
            //     'title' => $booking->title,
            //     'station_id' => $station->id,
            //     'color' => $color ? $color : '',

            // ]);

        } else {
            // Print message
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        
    }

    public function update(Request $request, $id)
    {

        // $station = $request['station_id'];
        // dd('11');
        $station = Session::get('station');
        // dd($station->id);
        $userLoggedin = auth()->user();   

       
        $booking = Reservation::find($id);

        //See whether update is made on the same day
        $dateOriginal = (new DateTime($booking->start_date))->format('Y-m-d');
        $dateNew = (new DateTime($request['start_date']))->format('Y-m-d');

        $date1 = Carbon::createFromFormat('Y-m-d',$dateOriginal);
        $date2 = Carbon::createFromFormat('Y-m-d', $dateNew);

        $result = $date1->eq($date2);

        $date = $request->begin;
        // dd($date);

        // See if the user has already made a reservation on that day for this station
        $bookings1 = Reservation::whereDate('start_date', $date)->where('user_id', $userLoggedin['id'])->where('station_id', $station->id)->get();
        // dd($bookings1);        

        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        if(($result && (count($bookings1) == 1)) || (!$result && (count($bookings1) == 0)) ){

            $booking->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            return response()->json('Event updated');

        }else{
            // Print message
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        

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
