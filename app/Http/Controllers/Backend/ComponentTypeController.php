<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ComponentType;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ComponentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $componenttypes = ComponentType::paginate(12);
        
        return view('backend.component.types.index',compact('componenttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = ComponentType::pluck('title', 'id');
        return view('backend.component.types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
                $data['thumb'] = $this->uploadThumb(null, $request->thumb, "component_types");
            }

            $type = new ComponentType($data);
            $type->save();
            return redirect()->route('admin.component.types.index')->with('Success', 'ComponentType was created !');

        } catch (\Exception $ex) {
            dd($ex);
            return abort(500, "Error 222");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ComponentType $componenttype
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
      */
    public function show(ComponentType $componentType)
    {
        return view('backend.component.types.show', compact("componentType"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ComponentType $componentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ComponentType $componentType)
    {
        $types = ComponentType::pluck('title', 'id');
        return view('backend.component.types.edit', compact('componentType','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComponentType $componentType)
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
                $data['thumb'] = $this->uploadThumb($componentType->thumbURL(), $request->thumb, "component_types");
            }

            $componentType->update($data);
            return redirect()->route('admin.component.types.index')->with('Success', 'ComponentType was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\ComponentType $componentType
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(ComponentType $componentType)
    {
        return view('backend.component.types.delete', compact('componentType'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CompoenentType $componentType
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(ComponentType $componentType)
    {
        try {
            // Delete the thumbnail form the file system
            $this->deleteThumb($componentType->thumbUrl());
            $componentType->delete();
            return redirect()->route('admin.component.types.index')->with('Success', 'ComponentType was deleted !');
        
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Remove the specified thumb from storage.
     *
     * @param Url $url
     * @return void
     */
    private function deleteThumb($currentURL)
    {
        if ($currentURL != null) {
            $oldImage = public_path($currentURL);
            if (File::exists($oldImage)) unlink($oldImage);
        }
    }
     /**
     * upload the specified thumb to storage.
     *
     * @param String $url
     * @param Intervention\Image\Facades\Image $newImage
     * @param String $folder
     * 
     * @return void
     */

     // Private function to handle thumb images
     private function uploadThumb($currentURL, $newImage, $folder)
     {
 
         // Delete the existing image
         $this->deleteThumb($currentURL);
 
         $imageName = time() . '.' . $newImage->extension();
         $newImage->move(public_path('img/'.$folder), $imageName);
         $imagePath = "/img/$folder/" . $imageName;
         $image = Image::make(public_path($imagePath))->fit(360, 360);
         $image->save();
 
         return $imageName;
     }


}
