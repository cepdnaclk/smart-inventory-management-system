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

    public function reverseSearchIndex()
    {
        $locations = Locations::pluck('location', 'id');
        foreach ($locations as $key => $value) {
            $full_location_path_array = $this->getFullLocationPathByLocationID($key);
            $locations[$key] = implode(' > ', array_reverse($full_location_path_array));
        }
        return view('backend.search.reverseIndex', compact('locations'));
    }

    public function reverseResults(Request $request)
    {
        $allItems = array();
//        this function is going to very resource heavy I think
//        TODO: optimize this. This will take a very long time if there are lots of items.
        $location = $request->location;
        $full_location_path_array = $this->getFullLocationPathByLocationID($location);
        $locationName = implode(' > ', array_reverse($full_location_path_array));


//        get all the items with the corresponding location id
        $allItemsLocationIDs = ItemLocations::where('location_id', $location)->get();

//        iterate on each item and find the entry from DB
        foreach ($allItemsLocationIDs as $eachItem) {
            $itemModel = $eachItem->get_item();
            if ($itemModel != null) {
                $allItems[] = $itemModel;
            }
        }
//        dd($allItems);

        return view('backend.search.reverseResults', compact('allItems', 'locationName'));
    }

}
