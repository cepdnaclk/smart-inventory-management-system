<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ConsumableType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ConsumableTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //$consumableTypes = ConsumableType::paginate(12);
        return view('backend.consumable.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $types =  ConsumableType::getFullTypeList();
        return view('backend.consumable.types.create', compact('types'));
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
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "consumable_types");
            }

            $type = new ConsumableType($data);
            $type->save();

            return redirect()->route('admin.consumable.types.index')->with('Success', 'ConsumableType was created !');
        } catch (\Exception $ex) {
            return abort(500, "Error 222");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ConsumableType $consumableType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(ConsumableType $consumableType)
    {
        return view('backend.consumable.types.show', compact('consumableType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(ConsumableType $consumableType)
    {
        $types = ConsumableType::getFullTypeList();
        return view('backend.consumable.types.edit', compact('consumableType', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, ConsumableType $consumableType)
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
                $data['thumb'] = $this->uploadThumb($consumableType->thumbURL(), $request->thumb, "consumable_types");
            }

            $consumableType->update($data);
            return redirect()->route('admin.consumable.types.index')->with('Success', 'ConsumableType was updated !');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param ConsumableType $consumableType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(ConsumableType $consumableType)
    {
        return view('backend.consumable.types.delete', compact('consumableType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ConsumableType $consumableType
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(ConsumableType $consumableType)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($consumableType->thumb);

            $consumableType->delete();
            return redirect()->route('admin.consumable.types.index')->with('Success', 'ConsumableType was deleted !');
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
    private function uploadThumb($currentURL, $newImage, $folder): string
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
