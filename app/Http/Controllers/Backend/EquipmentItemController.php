<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use App\Models\ItemLocations;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Torann\GeoIP\Location;

class EquipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $equipment = EquipmentItem::orderBy('id', 'asc')->paginate(16);
        return view('backend.equipment.items.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = EquipmentType::getFullTypeList();
        $locations = Locations::pluck('location', 'id');
        return view('backend.equipment.items.create', compact('types', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'brand' => 'string|nullable',
            'productCode' => 'string|nullable',
            'equipment_type_id' => 'numeric|required',
            'specifications' => 'string|nullable',
            'description' => 'string|nullable',
            'instructions' => 'string|nullable',

            // 'isElectrical' => 'accepted',
            'powerRating' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'quantity' => 'numeric',

            'width' => 'numeric|nullable',
            'length' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'weight' => 'numeric|nullable',

            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "equipment_items");
            }

            $type = new EquipmentItem($data);

            // Update checkbox condition
            $type->isElectrical = ($request->isElectrical != null);

            //            save first, otherwise the id is not there
            $type->save();
            return redirect()->route('admin.equipment.items.edit.location', $type)->with('Success', 'Equipment was created !');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(EquipmentItem $equipmentItem)
    {
        $locationCount = $this->getNumberOfLocationsForItem($equipmentItem);

        $locations_array = array();
        for ($i = 0; $i < $locationCount; $i++) {
            $locations_array[] = $this->getFullLocationPathAsString($equipmentItem, $i);
        }
        return view('backend.equipment.items.show', compact('equipmentItem', 'locations_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(EquipmentItem $equipmentItem)
    {
        $types = EquipmentType::getFullTypeList();
        //$this_item_location = ItemLocations::where('item_id', $equipmentItem->inventoryCode())->get();
        //if ($this_item_location->count() > 0) {
        //    $this_item_location = $this_item_location->first()->location_id;
        //} else {
        //    $this_item_location = null;
        //}
        //        dd($this_item_location);
        //        $locations = Locations::pluck('location', 'id');
        return view('backend.equipment.items.edit', compact('types', 'equipmentItem'));
    }


    /**
     * Edit the locations ot the item
     *
     * @param EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editLocation(EquipmentItem $equipmentItem)
    {
        $locations = Locations::all()->where('parent_location', 1)->all();

        return view('backend.equipment.items.edit-location', compact('equipmentItem', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, EquipmentItem $equipmentItem)
    {
        //         dd($request->request);
        $data = request()->validate([
            'title' => 'string|required',
            'brand' => 'string|nullable',
            'productCode' => 'string|nullable',
            'equipment_type_id' => 'numeric|required',
            'specifications' => 'string|nullable',
            'description' => 'string|nullable',
            'instructions' => 'string|nullable',

            'isElectrical' => 'nullable',
            'powerRating' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'quantity' => 'numeric',

            'width' => 'numeric|nullable',
            'length' => 'numeric|nullable',
            'height' => 'numeric|nullable',
            'weight' => 'numeric|nullable',

            'thumb' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $thumb = ($equipmentItem->thumb == NULL) ? NULL : $equipmentItem->thumbURL();
                $data['thumb'] = $this->uploadThumb($thumb, $request->thumb, "equipment_items");
            }

            // Update checkbox condition
            $equipmentItem->isElectrical = ($request->isElectrical != null);

            $equipmentItem->update($data);

            return redirect()->route('admin.equipment.items.index')->with('Success', 'Equipment was updated !');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(EquipmentItem $equipmentItem)
    {
        return view('backend.equipment.items.delete', compact('equipmentItem'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function destroy(EquipmentItem $equipmentItem)
    {

        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($equipmentItem->thumbURL());

            $equipmentItem->delete();

            // delete location entries
            $this_item_locations = ItemLocations::where('item_id', $equipmentItem->inventoryCode())->get();
            foreach ($this_item_locations as $loc) {
                $loc->delete();
            }

            return redirect()->route('admin.equipment.items.index')->with('Success', 'Equipment was deleted !');
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
