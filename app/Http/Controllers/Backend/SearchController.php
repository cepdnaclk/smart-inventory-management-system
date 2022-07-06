<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\EquipmentItem;
use App\Models\Machines;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use App\Models\ItemLocations;

class SearchController extends Controller
{
    public function index(){
        return view('backend.search.index');
    }
    public function results(Request $request){
    $keywords = $request->keywords;

    if (strlen($keywords) == 0){
        return view('backend.search.index')->with('status', 'Search string is empty. Please type something');
    }
    

    $searchResults = (new search())
    ->registerModel(ComponentItem::class,['title'])
    ->registerModel(ConsumableItem::class,['title'])
    ->registerModel(EquipmentItem::class,['title'])
    ->registerModel(Machines::class,['title'])
    ->search($keywords);

    return view('backend.search.results', compact('searchResults','keywords'));
    }
    }


