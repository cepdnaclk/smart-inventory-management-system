<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\EquipmentItem;
use App\Models\Machines;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function index(){
        return view('backend.search.index');
    }

    public function results(Request $request){
        $keywords = $request->keywords;

        $searchResults = (new Search())
            ->registerModel(ComponentItem::class,['title'])
            ->registerModel(EquipmentItem::class,['title'])
            ->registerModel(Machines::class,['title'])
            ->search($keywords);

//        dd($searchResults);

        return view('backend.search.results',compact('searchResults','keywords'));
    }
}
