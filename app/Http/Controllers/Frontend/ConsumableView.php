<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use Illuminate\Http\Request;

class ConsumableView extends Controller
{
    // Home Page
    public function index()
    {
        $consumableTypes = ConsumableType::all();
        return view('frontend.consumable.index', compact('consumableTypes'));
    }

    // All Consumables
    public function index_all()
    {
        $items = ConsumableItem::paginate(36);
        return view('frontend.consumable.all', compact('items'));
    }

    // consumable Category Page
    public function viewCategory(ConsumableType $consumableType)
    {
        $items = $consumableType->hasMany(ConsumableItem::class)->paginate(24);;
        return view('frontend.consumable.category', compact('items', 'consumableType'));
    }

    // conusmable Item Page
    public function viewItem(ConsumableItem $consumableItem)
    {
        $locationCount = $this->getNumberOfLocationsForItem($consumableItem);
        $locationStringArray = array();
        for ($i = 0; $i < $locationCount; $i++) {
            $locationStringArray[] = $this->getFullLocationPathAsString($consumableItem, $i);
        }
        return view('frontend.consumable.item', compact('consumableItem','locationStringArray'));
    }
}
