<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ItemLocations;
use App\Models\Locations;
use App\Models\RawMaterials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class RawMaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //$raw_materials = RawMaterials::paginate(16);
        return view('backend.raw_materials.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $availabilityOptions = RawMaterials::availabilityOptions();
        $locations = Locations::pluck('location', 'id');
        return view('backend.raw_materials.create', compact('availabilityOptions', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'code' => 'string|nullable|max:8',
            'title' => 'string|required',
            'color' => 'string|nullable',
            'description' => 'string|nullable',
            'specifications' => 'string|nullable',
            'quantity' => 'numeric|nullable',
            'unit' => 'string|nullable',
            'availability' => Rule::in(['AVAILABLE', 'NOT_AVAILABLE', 'CONDITIONALLY_AVAILABLE']),
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048',
            'notes' => 'string|nullable',
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "raw_materials");
            }

            $materials = new RawMaterials($data);
            $materials->save();
            return redirect()->route('admin.raw_materials.edit.location', $materials)->with('Success', 'Raw Material was created !');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\RawMaterials $rawMaterials
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(RawMaterials $rawMaterials)
    {
        $locationCount = $this->getNumberOfLocationsForItem($rawMaterials);

        $locations_array = array();
        for ($i = 0; $i < $locationCount; $i++) {
            $locations_array[] = $this->getFullLocationPathAsString($rawMaterials, $i);
        }
        return view('backend.raw_materials.show', compact('rawMaterials', 'locations_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\RawMaterials $rawMaterials
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(RawMaterials $rawMaterials)
    {
        //        $this_item_location = ItemLocations::where('item_id', $rawMaterials->inventoryCode())->get()[0]['location_id'];
        ////        dd($this_item_location);
        //        $locations = Locations::pluck('location', 'id');
        return view('backend.raw_materials.edit', compact('rawMaterials'));
    }

    public function editLocations(RawMaterials $rawMaterials)
    {
        $locations = Locations::all()->where('parent_location', 1)->all();

        return view('backend.raw_materials.edit-location', compact('rawMaterials', 'locations'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RawMaterials $rawMaterials
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, RawMaterials $rawMaterials)
    {
        //        dd($request, $rawMaterials);

        $data = request()->validate([
            'code' => 'string|nullable|max:8',
            'title' => 'string|required',
            'color' => 'string|nullable',
            'description' => 'string|nullable',
            'specifications' => 'string|nullable',
            'quantity' => 'numeric|nullable',
            'unit' => 'string|nullable',
            'availability' => Rule::in(['AVAILABLE', 'NOT_AVAILABLE', 'CONDITIONALLY_AVAILABLE']),
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048',
            'notes' => 'string|nullable',
        ]);

        //        dd($data);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($rawMaterials->thumbURL(), $request->thumb, "raw_materials");
            }

            $rawMaterials->update($data);


            return redirect()->route('admin.raw_materials.index')->with('Success', 'Raw Material was updated !');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     * @param \App\Models\RawMaterials $rawMaterials
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(RawMaterials $rawMaterials)
    {
        return view('backend.raw_materials.delete', compact('rawMaterials'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RawMaterials $rawMaterials
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(RawMaterials $rawMaterials)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($rawMaterials->thumbURL());

            $rawMaterials->delete();

            //            delete location entry
            $this_item_location = ItemLocations::where('item_id', $rawMaterials->inventoryCode())->delete();

            return redirect()->route('admin.raw_materials.index')->with('Success', 'Raw material was deleted !');
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
        $image = Image::make(public_path($imagePath))->fit(360, 360);
        $image->save();

        return $imageName;
    }
}
