<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ItemLocations;
use App\Models\Locations;
use App\Models\Machines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class MachinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $machines = Machines:: paginate(16);
        return view('backend.machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $typeOptions = Machines::types();
        $availabilityOptions = Machines::availabilityOptions();
        $locations = Locations::pluck('location', 'id');
        return view('backend.machines.create', compact('typeOptions', 'availabilityOptions', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\never|void
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'code' => 'string|nullable|max:8',
            'title' => 'string|required',
            'type' => Rule::in(['CNC', 'FDM_3D_PRINTER', 'LASER_CUTTER', 'PCB_MILL']),
            'location' => 'numeric|required',
            'build_width' => 'numeric|nullable|min:0',
            'build_length' => 'numeric|nullable|min:0',
            'build_height' => 'numeric|nullable|min:0',
            'power' => 'numeric|nullable|min:0',
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048',
            'specifications' => 'string|nullable',
            'status' => Rule::in(['AVAILABLE', 'NOT_AVAILABLE', 'CONDITIONALLY_AVAILABLE']),
            'notes' => 'string|nullable',
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "machines");
            }

            $filtered_data = $data;
            unset($filtered_data['location']);
            $machine = new Machines($filtered_data);
            $machine->save();

            $data_for_location = [
                'item_id' => $machine->inventoryCode(),
                'location_id' => $data['location']
            ];
            $location = new ItemLocations($data_for_location);

            $location->save();
            return redirect()->route('admin.machines.index')->with('Success', 'Machine was created !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Machines $machine
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Machines $machines)
    {
        $locations_array = $this->getFullLocationPathAsArray($machines,0);
        return view('backend.machines.show', compact('machines','locations_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Machines $machine
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Machines $machines)
    {
        $typeOptions = Machines::types();
        $availabilityOptions = Machines::availabilityOptions();

        $this_item_location = $machines->getLocations();

        $locations = Locations::pluck('location', 'id');

        return view('backend.machines.edit', compact('machines', 'typeOptions', 'availabilityOptions', 'this_item_location', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Machines $machine
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|void
     */
    public function update(Request $request, Machines $machines)
    {
        $data = request()->validate([
            'code' => 'string|nullable|max:8',
            'title' => 'string|required',
            'location' => 'numeric|required',

        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($machines->thumbURL(), $request->thumb, "machine");
            }

            $filtered_data = $data;
            unset($filtered_data['location']);
            $machines->update($filtered_data);


            $this_item_location = ItemLocations::where('item_id', $machines->inventoryCode())->get()[0];
            $new_location_data = [
                'location_id' => $data['location']
            ];
            $this_item_location->update($new_location_data);

            return redirect()->route('admin.machines.index')->with('Success', 'Machine was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     * @param \App\Models\Machines $machines
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Machines $machines)
    {
        return view('backend.machines.delete', compact('machines'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Machines $machines
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(Machines $machines)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($machines->thumbURL());

            $machines->delete();

            //            delete location entry
            $this_item_location = ItemLocations::where('item_id', $machines->inventoryCode())->get()[0];
            $this_item_location->delete();

            return redirect()->route('admin.machines.index')->with('Success', 'Machine was deleted !');

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
