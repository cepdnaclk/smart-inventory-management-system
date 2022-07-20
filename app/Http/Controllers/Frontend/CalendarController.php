<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\StationReservationMail;
use App\Models\Reservation;
use App\Models\Stations;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CalendarController extends Controller
{
    public function index(Stations $station)
    {
        // Get the model of the user logged in
        $userLoggedin = auth()->user();
        $events = [];

        // Get all the reservations for that particular station
        $bookings = Reservation::where('station_id', $station->id)->where('start_date', '>', Carbon::now()->subDays(8))->get();


        $color = null;

        foreach ($bookings as $booking) {
            if ($booking->user_id != $userLoggedin['id']) {
                $color = '#435258';
            } else {
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

        $today = date('Y-m-d H:i:s');
        // $today = Carbon::now()->addMinutes(330);
        // dd($today);
        return view('frontend.calendar.index', ['events' => $events, 'station' => $station, 'userLoggedin' => $userLoggedin, 'today' => $today]);
    }

    public function store(Request $request)
    {
        $station = Session::get('station');
        $userLoggedin = auth()->user();

        $stringLength = Str::length($request['title']);

        $request->validate([
            'title' => 'required|regex:^E/\d{2}/\d{3}$^',
        ]);


        $date = $request->begin;

        // See if the user has already made a reservation on that day for this station
        $bookings1 = Reservation::whereDate('start_date', $date)->where('user_id', $userLoggedin['id'])->where('station_id', $station->id)->get();


        // $bookings1 = Reservation::whereDate('start_date', $date)->where('user_id', $userLoggedin['id'])->get();

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

            $color = null;

            if ($booking->title == 'Try') {
                $color = '#33C0FF';
            }

            //***********mails****************

            // Nuwan: This part is working. So I added a 'if condition' to this in such a way that
            // it will be only executed in a web server.
            // Environment can be setup in the .env file
            
            
            if (App::environment(['local', 'staging'])) {
                // dd('Not sending emails');
            } else {
                
                try{
                    $enums = explode(',',$request->title);

                    foreach ($enums as $enum){

                        //get enumber
                        $enum1=explode('/',$enum);
                        $batch=$enum1[1];
                        $regnum=$enum1[2];

                        //set api url
                        $apiurl = 'https://api.ce.pdn.ac.lk/people/v1/students/E'.''.$batch.'/'.$regnum.'/';

                        //api call
                        $response = Http::withoutVerifying()
                        ->get($apiurl);

                        //extract email address
                        $email=($response['emails']['faculty']['name'].'@'.$response['emails']['faculty']['domain']);

                        //get user
                        $user = auth()->user();

                        //send mail
                        Mail::to($email)
                            ->send(new StationReservationMail(auth()->user(), $station, $booking));
                    }

                    }catch(\Exception $e){
                        return response()->json([
                            'error' => 'enumber null'
                        ], 404);
                    }

                }
            
                

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
                'error' => 'Unable to locate the event',
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

        $date1 = Carbon::createFromFormat('Y-m-d', $dateOriginal);
        $date2 = Carbon::createFromFormat('Y-m-d', $dateNew);

        $result = $date1->eq($date2);

        $date = $request->begin;
        // dd($date);

        // See if the user has already made a reservation on that day for this station
        $bookings1 = Reservation::whereDate('start_date', $date)->where('user_id', $userLoggedin['id'])->where('station_id', $station->id)->get();
        // dd($bookings1);

        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event',
            ], 404);
        }

        // TODO: If the start end times changed, it will be better to send the users an email
        // saying the time is changed (remind Google Calender events !)

        if (($result && (count($bookings1) == 1)) || (!$result && (count($bookings1) == 0))) {
            $booking->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return response()->json('Event updated');
        } else {
            // Print message
            return response()->json([
                'error' => 'Unable to locate the event',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $booking = Reservation::find($id);

        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event',
            ], 404);
        }

        $booking->delete();

        return $id;
    }
}
