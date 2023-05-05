<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\ComponentType;

class ComponentView extends Controller
{

    // Home Page
    public function index()
    {
        $componentType = ComponentType::all();
        return view('frontend.component.index', compact('componentType'));
    }

    // All Components
    public function index_all()
    {
        $items = ComponentItem::paginate(36);
        return view('frontend.component.all', compact('items'));
    }

    // component Category Page
    public function viewCategory(ComponentType $componentType)
    {
        $items = $componentType->hasMany(ComponentItem::class)->paginate(36);;
        return view('frontend.component.category', compact('items', 'componentType'));
    }

    // component Item Page
    public function viewItem(ComponentItem $componentItem)
    {
        $locationCount = $this->getNumberOfLocationsForItem($componentItem);
        $locationStringArray = array();
        for ($i = 0; $i < $locationCount; $i++) {
            $locationStringArray[] = $this->getFullLocationPathAsString($componentItem, $i);
        }

        return view('frontend.component.item', compact('componentItem', 'locationCount', 'locationStringArray'));
    }

    
    


}