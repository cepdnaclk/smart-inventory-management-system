<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComponentType;
use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use App\Models\ItemLocations;
use App\Models\Locations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ConsumableItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index()
    {
        $consumables = ConsumableItem::paginate(36);
        return view("backend.consumable.items.index", compact('consumables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = ConsumableType::pluck('title', 'id');
        $locations = Locations::pluck('location', 'id');
        return view('backend.consumable.items.create', compact('types','locations'));
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
            'char' => 'string|nullable',
            'consumable_type_id' => 'numeric|required',
            'specifications' => 'string|nullable',
            'formFactor' => 'nullable',
            'location' => 'numeric|required',
            'datasheetURL' => 'nullable',
            'quantity' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'thumb' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "consumable_items");
            }

            $filtered_data = $data;
            unset($filtered_data['location']);
            $consumableItem = new ConsumableItem($filtered_data);
            $consumableItem->save();


            $data_for_location = [
                'item_id' => $consumableItem->inventoryCode(),
                'location_id' => $data['location']
            ];
            $location = new ItemLocations($data_for_location);


            $location->save();
            return redirect()->route('admin.consumable.items.index')->with('Success', 'Consumable was created !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ConsumableItem $consumableItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(ConsumableItem $consumableItem)
    {
        $locations_array = $this->getLocationOfItem($consumableItem);
        return view('backend.consumable.items.show', compact("consumableItem",'locations_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ConsumableItem $consumableItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ConsumableItem $consumableItem)
    {
        $types = ConsumableType::pluck('title', 'id');
        $this_item_location = ItemLocations::where('item_id',$consumableItem->inventoryCode())->get()[0]['location_id'];
//        dd($this_item_location);
        $locations = Locations::pluck('location', 'id');
        return view('backend.consumable.items.edit', compact('types', 'consumableItem','locations','this_item_location'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ConsumableItem $consumableItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ConsumableItem $consumableItem)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'char' => 'string|nullable',
            'consumable_type_id' => 'numeric|required',
            'specifications' => 'string|nullable',
            'formFactor' => 'nullable',
            'location' => 'numeric|required',
            'datasheetURL' => 'nullable',
            'quantity' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'thumb' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($consumableItem->thumbURL(), $request->thumb, "consumable_items");
            }
            $filtered_data = $data;
            unset($filtered_data['location']);
            $consumableItem->update($filtered_data);


            $this_item_location = ItemLocations::where('item_id',$consumableItem->inventoryCode())->get()[0];
            $new_location_data = [
                'location_id' => $data['location']
            ];
            $this_item_location->update($new_location_data);

            return redirect()->route('admin.consumable.items.index')->with('Success', 'Consumable was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param ConsumableItem $consumableItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(ConsumableItem $consumableItem)
    {
        return view('backend.consumable.items.delete', compact('consumableItem'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param ConsumableItem $consumableItem
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function destroy(ConsumableItem $consumableItem)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($consumableItem->thumbURL());

            $consumableItem->delete();

            //            delete location entry
            $this_item_location = ItemLocations::where('item_id',$consumableItem->inventoryCode())->get()[0];
            $this_item_location->delete();
            return redirect()->route('admin.consumable.items.index')->with('Success', 'Consumable was deleted !');

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
