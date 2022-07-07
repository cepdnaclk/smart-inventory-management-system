<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\ItemLocations;
use App\Models\Locations;
use Torann\GeoIP\Location;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $equipmentTypes = EquipmentType::orderBy('id', 'asc')->paginate(16);
        return view('backend.equipment.types.index', compact('equipmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = EquipmentType::pluck('title', 'id');
        return view('backend.equipment.types.create', compact('types'));
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
            'parent_id' => 'integer|nullable', // TODO: Validate properly
            'subtitle' => 'string|nullable',
            'description' => 'string|nullable',
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "equipment_types");
            }

            $type = new EquipmentType($data);
            $type->save();
            return redirect()->route('admin.equipment.types.index')->with('Success', 'EquipmentType was created !');

        } catch (\Exception $ex) {
            return abort(500, "Error 222");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(EquipmentType $equipmentType)
    {
        return view('backend.equipment.types.show', compact('equipmentType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(EquipmentType $equipmentType)
    {
        $types = EquipmentType::pluck('title', 'id');
        return view('backend.equipment.types.edit', compact('equipmentType', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, EquipmentType $equipmentType)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'parent_id' => 'integer|nullable', // TODO: Validate properly
            'subtitle' => 'string|nullable',
            'description' => 'string|nullable',
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($equipmentType->thumbURL(), $request->thumb, "equipment_types");
            }

            $equipmentType->update($data);
            return redirect()->route('admin.equipment.types.index')->with('Success', 'EquipmentType was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(EquipmentType $equipmentType)
    {
        return view('backend.equipment.types.delete', compact('equipmentType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\EquipmentType $equipmentType
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(EquipmentType $equipmentType)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($equipmentType->thumbURL());

            $equipmentType->delete();
            return redirect()->route('admin.equipment.types.index')->with('Success', 'EquipmentType was deleted !');

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
