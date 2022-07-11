<?php



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
   

    public function results(Request $request)
    {
        $keywords = $request->keywords;

        if (strlen($keywords) == 0) {
            return view('frontend.index')->with('status', 'Search string is empty. Please type something');
        }

        $searchResults = (new Search())
            ->registerModel(ComponentItem::class, ['title', 'brand'])
            ->registerModel(EquipmentItem::class, ['title', 'brand'])
            ->registerModel(Machines::class, ['title'])
            ->registerModel(ConsumableItem::class, ['title'])
            ->registerModel(RawMaterials::class, ['title', 'description'])
            ->search($keywords);

        //create a view to show results on frontend and add the view below
        return view('frontend.search.results', compact('searchResults', 'keywords'));
    }
}

