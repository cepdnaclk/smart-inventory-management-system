<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;

class EquipmentView extends Controller
{

    // Home Page
    public function index()
    {
        $eqTypes = EquipmentType::all();
        return view('frontend.equipment.index', compact('eqTypes'));
    }

    // All Equipments
    public function index_all()
    {
        $items = EquipmentItem::paginate(36);
        return view('frontend.equipment.all', compact('items'));
    }

    // Equipment Category Page
    public function viewCategory(EquipmentType $equipmentType)
    {
        $items = $equipmentType->hasMany(EquipmentItem::class)->paginate(36);;
        // ->paginate(16);
        return view('frontend.equipment.category', compact('items', 'equipmentType'));
    }

    // Equipment Item Page
    public function viewItem(EquipmentItem $equipmentItem)
    {
        $locationCount = $this->getNumberOfLocationsForItem($equipmentItem);
        $locationStringArray = array();
        for ($i = 0; $i < $locationCount; $i++) {
            $locationStringArray[] = $this->getFullLocationPathAsString($equipmentItem, $i);
        }

        return view('frontend.equipment.item', compact('equipmentItem','locationStringArray','locationCount'));
    }
} 
