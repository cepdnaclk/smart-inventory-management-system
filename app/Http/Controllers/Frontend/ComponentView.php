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

    // component Category Page
    public function viewCategory(ComponentType $componentType)
    {
        $items = $componentType->hasMany(ComponentItem::class)->paginate(12);;
        return view('frontend.component.category', compact('items', 'componentType'));
    }

    // component Item Page
    public function viewItem(ComponentItem $componentItem)
    {
        return view('frontend.component.item', compact('componentItem'));
    }
}