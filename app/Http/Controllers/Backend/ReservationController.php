<?php

namespace App\Http\Controllers\Backend;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservation = Reservation::orderBy('station_id')->paginate(16);
        return view('backend.reservation.index', compact('reservation'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Reservation $reservation)
    {
       return view('backend.reservation.show', compact('reservation'));
    }


}
