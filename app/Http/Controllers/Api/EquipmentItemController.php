<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\EquipmentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class EquipmentItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = EquipmentItem::all();
        try {
            return response()->json($items,200);
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

            $item = new EquipmentItem($data);

            // Update checkbox condition
            $item->isElectrical = ($request->isElectrical != null);

            $item->save();
            return response()->json($item,200);

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
            $item = EquipmentItem::find($id);
            if($item!=null)
            {
                return response()->json($item,200);
            }
            else
            {
                return response()->json(["message"=>"Item is not found!"],404);
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
            $equipmentItem  = EquipmentItem::find($id);
            if($equipmentItem ==null){
                return response()->json(["message"=>"Item not found!"],404);
            }

            if ($request->thumb != null) {
                $data['thumb'] = $this->uploadThumb($equipmentItem->thumbURL(), $request->thumb, "equipment_items");
            }

            // Update checkbox condition
            $equipmentItem->isElectrical = ($request->isElectrical != null);

            $equipmentItem->update($data);
            return response()->json($equipmentItem,200);

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
            $equipmentItem = EquipmentItem::find($id);
            if($equipmentItem==null){
                return response()->json([
                    "message"=>"Item is not found"
                ],404);
            }
            // Delete the thumbnail form the file system
            $this->deleteThumb($equipmentItem->thumbURL());

            $equipmentItem->delete();
            return response()->json($equipmentItem,200);

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
        $items = EquipmentItem::query()
            ->where('title', 'LIKE', "%{$term}%")
            ->orWhere('description', 'LIKE', "%{$term}%")
            ->orWhere('brand', 'LIKE', "%{$term}%")
            ->orWhere('specifications', 'LIKE', "%{$term}%")
            ->orWhere('instructions', 'LIKE', "%{$term}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return $items;
    }
}
