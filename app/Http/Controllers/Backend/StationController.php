<?php

namespace App\Http\Controllers\Backend;

use App\Models\Stations;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\EquipmentItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class StationController extends Controller

{
    /**
     * Display a listing of the stations.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $station = Stations::orderBy('id')->paginate(16);
        return view('backend.station.index', compact('station'));
    }

    /**
     * Show the form for creating a new station.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function create()
    {
        $station = Stations::pluck('stationName', 'id');
        $equipment = EquipmentItem::pluck('title', 'id');
        return view('backend.station.create', compact('station', 'equipment'));
    }

    /**
     * Store a newly created station in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
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
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "stations");
            }
            $type = new Stations($data);
            $type->save();
            return redirect()->route('admin.station.index')->with('Success', 'Station was created !');
        } catch (\Exception $ex) {
            //dd($ex);
            return abort(500);
        }
    }

    /**
     * Display the specified station.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Http\Response
     */

    public function show(Stations $station)
    {
        return view('backend.station.show', compact('station'));
    }

    /**
     * Show the form for editing the specified station.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function edit(Stations $station)
    {
        $stations = Stations::pluck('stationName', 'id');
        return view('backend.station.edit', compact('station'));
    }

    /**
     * Update the specified station in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
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
                $data['thumb'] = $this->uploadThumb($station->thumb, $request->thumb, "stations");
            }
            $station->update($data);
            return redirect()->route('admin.station.index')->with('Success', 'Station was updated !');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Remove the specified station from storage.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function delete(Stations $station)
    {
        return view('backend.station.delete', compact('station'));
    }

    /**
     * Remove the specified station from storage.
     *
     * @param \App\Models\Station $station
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function destroy(Stations $station)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($station->thumb);

            $station->delete();
            return redirect()->route('admin.station.index')->with('Success', 'Station was deleted !');
        } catch (\Exception $ex) {
            return abort(500);
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
        $image = Image::make(public_path($imagePath))->fit(640, 480);
        $image->save();

        return $imageName;
    }
}
