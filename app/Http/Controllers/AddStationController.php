<?php

namespace App\Http\Controllers;

use App\Models\Stations;
use Illuminate\Http\Request;

class AddStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Stations::all();
        return view ('addstations.index')->with('stations', $stations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addstations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Stations::create($input);
        return redirect('addstation')->with('flash_message', 'Station Addedd!');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $station = Stations::find($id);
        return view('addstations.show')->with('stations', $station);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $station = Stations::find($id);
        return view('addstations.edit')->with('stations', $station);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $station = Stations::find($id);
        $input = $request->all();
        $station->update($input);
        return redirect('addstation')->with('flash_message', 'Station Updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stations::destroy($id);
        return redirect('addstation')->with('flash_message', 'Station deleted!');  
    }
}
