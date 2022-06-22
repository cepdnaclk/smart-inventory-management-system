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
        $equipment = EquipmentItem::orderBy('id', 'desc')->paginate(16);
        return view('backend.equipment.items.index', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = EquipmentType::pluck('title', 'id');
        $locations = Locations::pluck('location', 'id');
        return view('backend.equipment.items.create', compact('types','locations'));
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
            'location' => 'numeric|required',
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

            $filtered_data = $data;
            unset($filtered_data['location']);
            $type = new EquipmentItem($filtered_data);

            // Update checkbox condition
            $type->isElectrical = ($request->isElectrical != null);

            //            save first, otherwise the id is not there
            $type->save();

            $data_for_location = [
                'item_id' => $type->inventoryCode(),
                'location_id' => $data['location']
            ];
            $location = new ItemLocations($data_for_location);


            $location->save();
            return redirect()->route('admin.equipment.items.index')->with('Success', 'Equipment was created !');

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
        $locations_array = $this->getLocationOfItem($equipmentItem);

        return view('backend.equipment.items.show', compact('equipmentItem','locations_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EquipmentItem $equipmentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(EquipmentItem $equipmentItem)
    {
        $types = EquipmentType::pluck('title', 'id');
        $this_item_location = ItemLocations::where('item_id',$equipmentItem->inventoryCode())->get()[0]['location_id'];
//        dd($this_item_location);
        $locations = Locations::pluck('location', 'id');
        return view('backend.equipment.items.edit', compact('types', 'equipmentItem','this_item_location','locations'));
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

            'location' => 'numeric|required',
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
                $data['thumb'] = $this->uploadThumb($equipmentItem->thumbURL(), $request->thumb, "equipment_items");
            }

            // Update checkbox condition
            $equipmentItem->isElectrical = ($request->isElectrical != null);

            $filtered_data = $data;
            unset($filtered_data['location']);
            $equipmentItem->update($filtered_data);

            $this_item_location = ItemLocations::where('item_id',$equipmentItem->inventoryCode())->get()[0];
            $new_location_data = [
                'location_id' => $data['location']
            ];
            $this_item_location->update($new_location_data);

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

            //            delete location entry
            $this_item_location = ItemLocations::where('item_id',$equipmentItem->inventoryCode())->get()[0];
            $this_item_location->delete();

            return redirect()->route('admin.equipment.items.index')->with('Success', 'Equipment was deleted !');

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
