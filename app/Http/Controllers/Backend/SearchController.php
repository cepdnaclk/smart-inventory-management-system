<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\ConsumableItem;
use App\Models\EquipmentItem;
use App\Models\ItemLocations;
use App\Models\Locations;
use App\Models\Machines;
use App\Models\RawMaterials;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function index()
    {
        return view('backend.search.index');
    }

    public function results(Request $request)
    {
        $keywords = $request->keywords;

        if (strlen($keywords) == 0) {
            return view('backend.search.index')->with('status', 'Search string is empty. Please type something');
        }

        $searchResults = (new Search())
            ->registerModel(ComponentItem::class, ['title', 'brand'])
            ->registerModel(EquipmentItem::class, ['title', 'brand'])
            ->registerModel(Machines::class, ['title', 'brand'])
            ->registerModel(ConsumableItem::class, ['title', 'brand'])
            ->registerModel(RawMaterials::class, ['title', 'description'])
            ->search($keywords);

        return view('backend.search.results', compact('searchResults', 'keywords'));
    }

    public function reverseSearch()
    {
        $locations = Locations::pluck('location', 'id');
//        dd($locations);
        return view('backend.search.reverseIndex', compact('locations'));
    }

    public function reverseResults(Request $request)
    {
        $allItems = array();
//        this function is going to very resource heavy I think
//        TODO: optimize this. This will take a very long time if there are lots of items.
        $location = $request->location;
        $locationName = Locations::where('id', $location)->get()[0]->location;


//        get all the items with the corresponding location id
        $allItemsLocationIDs = ItemLocations::where('location_id', $location)->get();

//        iterate on each item and find the entry from DB
        foreach ($allItemsLocationIDs as $eachItem) {
            $item_id = $eachItem->item_id;
            $exploded = explode("/", $item_id);
            if ($exploded[0] == "EQ") {
                $thisItem = EquipmentItem::where('id', end($exploded))->get();
                $allItems[] = $thisItem[0];
            } elseif ($exploded[0] == "MC") {
                $thisItem = Machines::where('id', end($exploded))->get();
                $allItems[] = $thisItem[0];
            } elseif ($exploded[1] == "CS") {
                $thisItem = ConsumableItem::where('id', end($exploded))->get();
                $allItems[] = $thisItem[0];
            } elseif ($exploded[0] == "RW") {
                $thisItem = RawMaterials::where('id', (int)end($exploded))->get();
//                dd($thisItem);
                $allItems[] = $thisItem[0];
            } elseif ($exploded[0] == "CM") {
                $thisItem = ComponentItem::where('id', end($exploded))->get();
                $allItems[] = $thisItem[0];
            }
        }
//        dd($allItems);

        return view('backend.search.reverseResults', compact('allItems', 'locationName'));
    }
}
