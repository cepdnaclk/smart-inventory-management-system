<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Locations;
use Illuminate\Http\Request;

class LocationsController extends Controller
{

    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //$locations = Locations::all();
        return view('backend.locations.index');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $locations = Locations::getFullLocationStringFromPluck();
        return view('backend.locations.create', compact('locations'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'locationName' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:locations,location'
                ],
                'parentLocation' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $allLocations = Locations::pluck('id')->toArray();
                        if (!in_array($value, $allLocations)) {
                            $fail(__('The parent location does not exist.'));
                        }
                    }
                ]
            ]);

            Locations::create([
                'location' => $data['locationName'],
                'parent_location' => $data['parentLocation']
            ]);

            return redirect()->route('admin.locations.index')->with('Success', 'Equipment was created !');
        } catch (\Exception $e) {
            return abort(500);
        }

    }

    /**
     * @param Locations $location
     * @return void
     */
    public function show(Locations $location)
    {
//        not used
    }

    /**
     * @param Locations $location
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Locations $location)
    {
        $locations = Locations::getFullLocationStringFromPluck();
        return view('backend.locations.edit', compact('location', 'locations'));
    }

    /**
     * @param Request $request
     * @param Locations $location
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function update(Request $request, Locations $location)
    {
        try {
            $data = $request->validate([
                'locationName' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'parentLocation' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $allLocations = Locations::pluck('id')->toArray();
                        if (!in_array($value, $allLocations)) {
                            $fail(__('The parent location does not exist.'));
                        }
                    }
                ]
            ]);
            $location->update([
                'location' => $data['locationName'],
                'parent_location' => $data['parentLocation']
            ]);

            return redirect()->route('admin.locations.index')->with('Success', 'Location was updated !');
        } catch (\Exception $e) {
            return abort(500);
        }
    }

    /**
     * @param Locations $location
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Locations $location)
    {
        return view('backend.locations.delete', compact('location'));
    }

    /**
     * @param Locations $location
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function destroy(Locations $location)
    {
        try {
            $location->delete();
            return redirect()->route('admin.locations.index')->with('Success', 'Location was deleted !');
        } catch (\Exception $e) {
            return abort(500);
        }
    }

}