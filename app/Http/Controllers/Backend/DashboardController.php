<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Models\ComponentItem;
use App\Models\ComponentType;
use App\Models\ConsumableItem;
use App\Models\ConsumableType;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;
use function PHPUnit\Framework\countOf;
use App\Models\OrderApproval;

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
        $orderrequest_lecturer=OrderApproval::where('lecturer_id',auth()->user()->id)->where('is_approved_by_lecturer', '=', 0)->count();

        return view('backend.dashboard', compact('userCount', 'equipmentCount', 'equipmentTypeCount', 'componentCount', 'componentTypeCount', 'consumableCount', 'consumableTypeCount','orderrequest_lecturer'));
    }
}
