<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Models\ComponentItem;
use App\Models\ComponentType;
use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use App\Models\Stations;

use function PHPUnit\Framework\countOf;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userCount = User::all()->count();
        $equipmentCount = EquipmentItem::all()->count();
        $equipmentTypeCount = EquipmentType::all()->count();
        $componentCount = ComponentItem::all()->count();
        $componentTypeCount = ComponentType::all()->count();
        $consumableCount = ConsumableItem::all()->count();
        $consumableTypeCount = ConsumableType::all()->count();
        $stationCount = Stations::all()->count();
        $consumableCount = ConsumableItem::all()->count();
        $consumableTypeCount = ConsumableType::all()->count();

        return view('backend.dashboard', compact('userCount', 'equipmentCount', 'equipmentTypeCount', 'componentCount', 'componentTypeCount', 'consumableCount', 'consumableTypeCount', 'stationCount'));
    }
}
