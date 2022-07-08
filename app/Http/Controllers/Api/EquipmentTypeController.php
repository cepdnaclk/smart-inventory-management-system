<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = EquipmentType::all();
        try {
            return response()->json($types,200);
        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
            return response()->json($type,200);

        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try 
        {
            $type = EquipmentType::find($id);
            if($type!=null)
            {
                return response()->json($type,200);
            }
            else
            {
                return response()->json(["message"=>"Type is not found!"],404);
            }
        }
        catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'title' => 'string|required',
            'parent_id' => 'integer|nullable', // TODO: Validate properly
            'subtitle' => 'string|nullable',
            'description' => 'string|nullable',
            'thumb' => 'image|nullable|mimes:jpeg,jpg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            

            $equipmentType  = EquipmentType::find($id);
            if($equipmentType ==null){
                return response()->json(["message"=>"Item not found!"],404);
            }
            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($equipmentType->thumbURL(), $request->thumb, "equipment_items");
            }


            $equipmentType->update($data);
            return response()->json($equipmentType,200);

        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $equipmentType = EquipmentType::find($id);
            if($equipmentType==null){
                return response()->json([
                    "message"=>"Type is not found"
                ],404);
            }
            // Delete the thumbnail form the file system
            $this->deleteThumb($equipmentType->thumbURL());

            $equipmentType->delete();
            return response()->json($equipmentType,200);

        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
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

    public function search(Request $request){
        // Get the search value from the request
        $term = $request->query('term');
    
        // search in the title and body columns from the posts table
        $types = EquipmentType::query()
            ->where('title', 'LIKE', "%{$term}%")
            ->orWhere('subtitle', 'LIKE', "%{$term}%")
            ->orWhere('description', 'LIKE', "%{$term}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return $types;
    }
}
