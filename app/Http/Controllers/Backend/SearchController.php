<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function index(){
        return view('backend.search.index');
    }

    public function results(Request $request){
        $keywords = $request->keywords;

        if (strlen($keywords) == 0){
//            change the test along with this text
            return view('backend.search.index')->with('status', 'Search string is empty. Please type something');
        }

        $searchResults = (new Search())
            ->registerModel(ComponentItem::class,['title','brand'])
            ->registerModel(EquipmentItem::class,['title','brand'])
            ->registerModel(Machines::class,['title','brand'])
            ->registerModel(ConsumableItem::class,['title','brand'])
            ->registerModel(RawMaterials::class,['title','description'])
//            TODO: add raw materials here
            ->search($keywords);

        return view('backend.search.results',compact('searchResults','keywords'));
    }
}
