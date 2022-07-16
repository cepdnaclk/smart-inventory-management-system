<?php

namespace App\Http\Controllers\frontend;

use DateTime;
use Carbon\Carbon;
use App\Models\Stations;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
            'E_numbers' => 'string|required',
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048',
            'thumb_after' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048'
        ]);


            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($reservation->thumbURL(), $request->thumb, "reservations");
            }
            elseif ($request->thumb_after != null) {
                $data['thumb_after'] = $this->uploadThumb($reservation->thumbURL_after(), $request->thumb_after, "reservations");
            }
            // $reservation->update($data);
            // return redirect()->route('frontend.reservation.index')->with('Success', 'Reservation was updated !');

     

        $dateNew = (new DateTime($data['start_date']))->format('Y-m-d');

        $date1 = Carbon::createFromFormat('Y-m-d',$dateOriginal);
        $date2 = Carbon::createFromFormat('Y-m-d', $dateNew);

        $result = $date1->eq($date2);

        // dd($result);

        $start = new DateTime($request['start_date']);
        $end = new DateTime($request['end_date']);
        $diff = $start->diff($end);
        $minutes = ($diff->h*60) + ($diff->s/60) + ($diff->i) + ($diff->d*24*60) + ($diff->m*30*24*60) + ($diff->y*365*24*60);

        //For overlap check
        $res = Reservation::whereDate('start_date', $start)->where('station_id', $data['station_id'])->get();

        $flag = false;
        foreach($res as $r){
            if($r->user_id != $userLoggedin['id']){
                $flag = $this->isAnOverlapEvent($start, $end, $r);
            }   
        }
        
        
        

       
        // See if the user has already made a reservation on that day for this station
        $bookings1 = Reservation::whereDate('start_date', $start)->where('user_id', $userLoggedin['id'])->where('station_id', $data['station_id'])->get();

        // dd(count($bookings1));

        $data = [
            'station_id' => $request['station_id'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'E_numbers' => $request['E_numbers'],
            'duration' => $minutes,
            'thumb' => $request->thumb,
            'thumb_after' => $request->thumb_after,
            
        ];

        if ($userLoggedin['id'] != $reservation->user_id){
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not update this reservation');   
        }elseif($data['duration'] > 240){
            return redirect()->route('frontend.reservation.index')->with('Error', 'Reservation was not updated! Reservation can not exceed 4 hours');           
        }elseif($flag){
            return redirect()->route('frontend.reservation.index')->with('Error', 'Reservation was not updated! Time slot not available');   
        }elseif((count($bookings1) == 1) && $result && !$flag){
            $reservation->update($data);
            return redirect()->route('frontend.reservation.index')->with('Success', 'Reservation was updated !');            
        }elseif((count($bookings1) == 0 && !$flag)){
            $reservation->update($data);
            return redirect()->route('frontend.reservation.index')->with('Success', 'Reservation was updated !'); 
        }elseif((count($bookings1) == 1) && !$result){
            return redirect()->route('frontend.reservation.index')->with('Error', 'Reservation was not updated! Can not make multiple reservations in one day');   
        }
        

    }

    public function isAnOverlapEvent(DateTime $eventStartDay, DateTime $eventEndDay, Reservation $res) {
        // var events = $('#calendar').fullCalendar('clientEvents');
            $resStart = new DateTime($res->start_date);    
            $resEnd = new DateTime($res->end_date);

            // dd($eventStartDay, $res->start_date);      
            // start-time in between any of the events
            if ($eventStartDay > $resStart && $eventStartDay < $resEnd ) {
                // dd('hi1');
                return true;
            }
            //end-time in between any of the events
            if ($eventEndDay > $resStart && $eventEndDay < $resEnd) {
                // dd('hi2');
                return true;
            }
            //any of the events in between/on the start-time and end-time
            if ($eventStartDay <= $resStart && $eventEndDay >= $resEnd) {
                // dd('hi3');
                return true;
            }
        
        // dd('hi4');
        return false;
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Reservation $reservation)
    {
        $station = Stations::find($reservation->station_id);
        return view('frontend.reservation.delete', compact('reservation', 'station'));
    }

    public function destroy(Reservation $reservation)
    {
        $userLoggedIn = auth()->user();
        $booking = Reservation::find($reservation->id);

        $this->deleteThumb($reservation->thumbURL());
        $this->deleteThumb($reservation->thumbURL_after());

        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        if($userLoggedIn['id'] == $booking->user_id){
            $booking->delete();

            return redirect()->route('frontend.reservation.index')->with('Success', 'Reservation was deleted !');
        }else{
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not delete this reservation!');
        }
        
    }

    
    private function deleteThumb($currentURL)
    {
        if ($currentURL != null) {
            $oldImage = public_path($currentURL);
            if (File::exists($oldImage)) unlink($oldImage);
        }
    }

    // Private function to handle thumb images
    private function uploadThumb($currentURL, $newImage, $folder)
    {

        // Delete the existing image
        $this->deleteThumb($currentURL);

        $imageName = time() . '.' . $newImage->extension();
        $newImage->move(public_path('img/' . $folder), $imageName);
        $imagePath = "/img/$folder/" . $imageName;
        $image = Image::make(public_path($imagePath))->fit(360, 360);
        $image->save();

        return $imageName;
    }
    

    
}
