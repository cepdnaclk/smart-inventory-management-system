<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Stations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class AdminStationController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $station = Stations::orderBy('id')->paginate(16);
        return view('backend.station.index', compact('station'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $station = Stations::pluck('stationName', 'id');
      return view('backend.station.create', compact('station'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
       $data = request()->validate([
        'stationName' => 'string|required',
        'description' => 'string|nullable',
        'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048',
        'capacity' => 'numeric|required'

    ]);

    try {
        if ($request->thumb != null) {
            $data['thumb'] = $this->uploadThumb(null, $request->thumb, "station");
        }

        $type = new Stations($data);


        $type->save();
        return redirect()->route('admin.station.index')->with('Success', 'Station was created !');

    } catch (\Exception $ex) {
        return abort(500);
    }   
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show(Stations $station)
    {
        return view('backend.station.show', compact('station'));
    }
*/
    public function show(Stations $station)
    {
       return view('backend.station.show', compact('station'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stations $station)
    {
        $stations = Stations::pluck('stationName', 'id');
        return view('backend.station.edit', compact('station'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stations $station)
    { 
                $data = request()->validate([
                'stationName' => 'string|required',
                'description' => 'string|nullable',
                'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048',
                'capacity' => 'numeric|required'

        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($station->thumbURL(), $request->thumb, "station");
            }

            $station->update($data);
            return redirect()->route('admin.station.index')->with('Success', 'Station was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Stations $station)
    {
        return view('backend.station.delete', compact('station'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Station $station
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function destroy(Stations $station)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($station->thumbURL());

            $station->delete();
            return redirect()->route('admin.station.index')->with('Success', 'Station was deleted !');

        } catch (\Exception $ex) {
            return abort(500);
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
