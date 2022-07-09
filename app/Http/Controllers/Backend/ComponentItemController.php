<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\ComponentType;
use App\Models\ItemLocations;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Torann\GeoIP\Location;

class ComponentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index()
    {
        $components = ComponentItem::paginate(16);
        return view("backend.component.items.index", compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = ComponentType::pluck('title', 'id');
        $locations = Locations::pluck('location', 'id');
        return view('backend.component.items.create', compact('types','locations'));
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
            'component_type_id' => 'numeric|required',

            'location' => 'numeric|required',
            'specifications' => 'string|nullable',
            'description' => 'string|nullable',
            'instructions' => 'string|nullable',

            'isAvailable' => 'nullable',
            'isElectrical' => 'nullable',
            'powerRating' => 'numeric|nullable',
            'quantity' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'size' => 'string|nullable',   // [small, medium, large]

            'thumb' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "component_items");
            }

            $filtered_data = $data;
            unset($filtered_data['location']);
            $type = new ComponentItem($filtered_data);

            // Update checkbox condition
            $type->isAvailable = ($request->isAvailable != null);
            $type->isElectrical = ($request->isElectrical != null);

//            save first, otherwise the id is not there
            $type->save();

            $data_for_location = [
                'item_id' => $type->inventoryCode(),
                'location_id' => $data['location']
            ];
            $location = new ItemLocations($data_for_location);


            $location->save();
//            dd($location);
            return redirect()->route('admin.component.items.index')->with('Success', 'component was created !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ComponentItem $componentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(ComponentItem $componentItem)
    {
        $locations_array = $this->getFullLocationPathAsArray($componentItem,0);
        return view('backend.component.items.show', compact("componentItem",'locations_array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ComponentItem $componentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ComponentItem $componentItem)
    {
        $types = ComponentType::pluck('title', 'id');
        $this_item_location = ItemLocations::where('item_id',$componentItem->inventoryCode())->get()[0]['location_id'];
//        dd($this_item_location);
        $locations = Locations::pluck('location', 'id');
        return view('backend.component.items.edit', compact('types', 'componentItem','locations','this_item_location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ComponentItem $componentItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ComponentItem $componentItem)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'brand' => 'string|nullable',
            'productCode' => 'string|nullable',
            'component_type_id' => 'numeric|required',

            'location' => 'numeric|required',
            'specifications' => 'string|nullable',
            'description' => 'string|nullable',
            'instructions' => 'string|nullable',

            'isAvailable' => 'boolean|nullable',
            'isElectrical' => 'boolean|nullable',
            'powerRating' => 'numeric|nullable',
            'quantity' => 'numeric|nullable',
            'price' => 'numeric|nullable',
            'size' => 'string|nullable',   // [small, medium, large]

            'thumb' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($componentItem->thumbURL(), $request->thumb, "component_items");
            }

            // Update checkbox condition
            $componentItem['isAvailable'] = isset($request->isAvailable) ? 1 : 0;
            $componentItem['isElectrical'] = isset($request->isElectrical) ? 1 : 0;

            $filtered_data = $data;
            unset($filtered_data['location']);
            $componentItem->update($filtered_data);

            $this_item_location = ItemLocations::where('item_id',$componentItem->inventoryCode())->get()[0];
            $new_location_data = [
                'location_id' => $data['location']
            ];
            $this_item_location->update($new_location_data);


            return redirect()->route('admin.component.items.index')->with('Success', 'Component was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\ComponentItem $componentItem
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(ComponentItem $componentItem)
    {
        return view('backend.component.items.delete', compact('componentItem'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ComponentItem $componentItem
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function destroy(ComponentItem $componentItem)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($componentItem->thumbURL());

            $componentItem->delete();

//            delete location entry
            $this_item_location = ItemLocations::where('item_id',$componentItem->inventoryCode())->get()[0];
            $this_item_location->delete();

            return redirect()->route('admin.component.items.index')->with('Success', 'Component was deleted !');

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
