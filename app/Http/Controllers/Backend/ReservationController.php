<?php

namespace App\Http\Controllers\Backend;

use DateTime;

use DateInterval;
use Carbon\Carbon;
use App\Models\Stations;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ReservationController extends Controller

{
    /**
     * Display a listing of the reservations of all users for the maintainer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservation = Reservation::orderBy('start_date', 'desc')->paginate(16);
        return view('backend.reservation.index', compact('reservation'));
    }

    /**
     * Display a listing of the reservations of the particular user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_user()
    {
        $userLoggedin = auth()->user();
        // dd($userLoggedin);
        $reservation = Reservation::where('user_id', $userLoggedin['id'])->orderBy('start_date', 'desc')->paginate(16);
        return view('backend.reservation.user.index', compact('reservation', 'userLoggedin'));
    }

    /**
     * Redirection to the updating interface.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {

        $userLoggedin = auth()->user();


        $stations = Stations::pluck('stationName', 'id');
        $station = Stations::find($reservation->station_id);

        if ($userLoggedin['id'] != $reservation->user_id) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not view that reservation for updating!');
        } else {
            return view('backend.reservation.user.edit', compact('reservation', 'stations', 'station'));
        }
    }

    public function edit_main(Reservation $reservation)
    {

        $stations = Stations::pluck('stationName', 'id');
        $station = Stations::find($reservation->station_id);
        return view('backend.reservation.edit', compact('reservation', 'stations', 'station'));
    }


    /**
     * Display the selected reservation.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show(Reservation $reservation)
    {
        return view('backend.reservation.show', compact('reservation'));
    }

    public function show_user(Reservation $reservation)
    {
        return view('backend.reservation.user.show', compact('reservation'));
    }

    /**
     * Redirect to the approving interface for maintainer.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function confirm(Reservation $reservation)
    {

        $stations = Stations::pluck('stationName', 'id');
        $station = Stations::find($reservation->station_id);
        return view('backend.reservation.confirm', compact('reservation', 'stations', 'station'));
    }


    /**
     * Approve interface with form for the maintainer.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function approve(Request $request, Reservation $reservation)
    {
        $data = request()->validate([
            'comments' => 'string|nullable',
            'status' => 'string|required'
        ]);

        $data = [
            'comments' => $request->comments,
            'status' => $request->status,

        ];
        return redirect()->route('admin.reservation.index')->with('Success', 'Reservation was approved !');
    }


    /**
     * Updating the reservation.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Reservation $reservation)
    {
        $userLoggedin = auth()->user();

        $dateOriginal = (new DateTime($reservation->start_date))->format('Y-m-d');
        $dateOriginal1 = (new DateTime($reservation->start_date))->format('Y-m-d H:i:s');

        // Data validation
        $data = request()->validate([
            'station_id' => 'numeric|required',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s',
            'E_numbers' => 'required|regex:^E/\d{2}/\d{3}$^',
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:5120',
            'thumb_after' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:5120'

        ]);

        /*************  Check whether any changes were made to the date ********/
        $dateNew = (new DateTime($data['start_date']))->format('Y-m-d');
        $dateNew1 = (new DateTime($data['start_date']))->format('Y-m-d H:i:s');

        $date1 = Carbon::createFromFormat('Y-m-d', $dateOriginal);
        $date2 = Carbon::createFromFormat('Y-m-d', $dateNew);
        $result = $date1->eq($date2);

        /*****************************************************************************/

        // Calculate the duration of the reservation in minutes
        $start = new DateTime($request['start_date']);
        $end = new DateTime($request['end_date']);
        $diff = $start->diff($end);
        $minutes = ($diff->h * 60) + ($diff->s / 60) + ($diff->i) + ($diff->d * 24 * 60) + ($diff->m * 30 * 24 * 60) + ($diff->y * 365 * 24 * 60);

        //Check for overlap of events 
        $res = Reservation::whereDate('start_date', $start)->where('station_id', $data['station_id'])->get();
        $flag = false;
        foreach ($res as $r) {
            if ($r->user_id != $userLoggedin['id']) {
                $flag = $this->isAnOverlapEvent($start, $end, $r);
            }
        }

        // See if the user has already made a reservation on that day for this station
        $bookings1 = Reservation::whereDate('start_date', $start)->where('user_id', $userLoggedin['id'])->where('station_id', $data['station_id'])->get();

        // See whether the reservation is being made too early (more than a month in advance)
        $todayDate = date('Y-m-d H:i:s');
        $today = new DateTime($todayDate);
        $today->add(new DateInterval('PT5H30M'));

        $resDiff = $today->diff($start);
        $minutesDiff = ($resDiff->h * 60) + ($resDiff->s / 60) + ($resDiff->i) + ($resDiff->d * 24 * 60) + ($resDiff->m * 30 * 24 * 60) + ($resDiff->y * 365 * 24 * 60);

        // Ensuring a reservation made in the past can not be updated
        if ($today > $start) {
            $minutesDiff = -1;
        }


        $data = [
            'station_id' => $request['station_id'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'E_numbers' => $request['E_numbers'],
            'duration' => $minutes,
        ];

        if ($request->thumb != null) {
            $data['thumb'] = $this->uploadThumb($reservation->thumb, $request->thumb, "reservations");
        }

        if ($request->thumb_after != null) {
            $thumb = ($reservation->thumb_after == NULL) ? NULL : $reservation->thumbURL_after();
            $data['thumb_after'] = $this->uploadThumb($thumb, $request->thumb_after, "reservations_after");
        }


        // Test case check
        if ($userLoggedin['id'] != $reservation->user_id) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not update this reservation');
        } elseif ($today >= $start) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'Reservation was not updated! You can not make/edit a reservation for a date that has passed.');
        } elseif (($minutesDiff > 43200) && $start > $today) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not make a reservation for that date this early.');
        } elseif ($data['duration'] > 240) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'Reservation was not updated! Reservation can not exceed 4 hours');
        } elseif ($flag) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'Reservation was not updated! Time slot not available');
        } elseif ((count($bookings1) == 1) && $result && !$flag && ($minutesDiff < 43200)) {
            $reservation->update($data);
            return redirect()->route('frontend.reservation.index')->with('Success', 'Reservation was updated !');
        } elseif ((count($bookings1) == 0 && !$flag && ($minutesDiff < 43200))) {
            $reservation->update($data);
            return redirect()->route('frontend.reservation.index')->with('Success', 'Reservation was updated !');
        } elseif ((count($bookings1) == 1) && !$result) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'Reservation was not updated! Can not make multiple reservations in one day');
        }
    }

    /**
     * Updating the comments and approval.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function update_main(Request $request, Reservation $reservation)
    {
        $data = request()->validate([
            'status' => 'string|nullable',
            'comments' => 'string|nullable'
        ]);

        $data = [
            'status' => $request['status'],
            'comments' => $request['comments'],

        ];

        $reservation->update($data);
        return redirect()->route('admin.reservation.index')->with('Success', 'Reservation status was saved !');
    }

    public function isAnOverlapEvent(DateTime $eventStartDay, DateTime $eventEndDay, Reservation $res)
    {
        // var events = $('#calendar').fullCalendar('clientEvents');
        $resStart = new DateTime($res->start_date);
        $resEnd = new DateTime($res->end_date);

        // start-time in between any of the events
        if ($eventStartDay > $resStart && $eventStartDay < $resEnd) {
            return true;
        }
        //end-time in between any of the events
        if ($eventEndDay > $resStart && $eventEndDay < $resEnd) {
            return true;
        }
        //any of the events in between/on the start-time and end-time
        if ($eventStartDay <= $resStart && $eventEndDay >= $resEnd) {
            return true;
        }

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
        $userLoggedIn = auth()->user();
        $station = Stations::find($reservation->station_id);

        if ($userLoggedIn['id'] == $reservation->user_id) {
            return view('backend.reservation.user.delete', compact('reservation', 'station'));
        } else {
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not delete this reservation!');
        }
    }

    /**
     * Delete reservation from the storage.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function destroy(Reservation $reservation)
    {
        $userLoggedIn = auth()->user();
        $booking = Reservation::find($reservation->id);

        $this->deleteThumb($reservation->thumb);
        $this->deleteThumb($reservation->thumb_after);

        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        $todayDate = date('Y-m-d H:i:s');
        $today = new DateTime($todayDate);
        $start = new DateTime($reservation['start_date']);

        if ($userLoggedIn['id'] == $booking->user_id && (($reservation->status != null && $reservation->status == 'approved') || ($start > $today))) {
            $booking->delete();
            return redirect()->route('frontend.reservation.index')->with('Success', 'Reservation was deleted !');
        } elseif (($reservation->status == null || $reservation->status == 'pending' || $reservation->status == 'rejected') && $start > $today) {
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not delete this reservation as it has not been approved!');
        } else {
            return redirect()->route('frontend.reservation.index')->with('Error', 'You can not delete this reservation!');
        }
    }

    private function deleteThumb($currentURL)
    {
        if ($currentURL != null && $currentURL != config('constants.frontend.dummy_thumb')) {
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


        $image = Image::make(public_path($imagePath));
        $image->save();

        return $imageName;
    }
}
