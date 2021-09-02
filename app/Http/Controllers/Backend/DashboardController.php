<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Auth\Models\User;
use App\Models\EquipmentItem;
use App\Models\EquipmentType;

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
        $userCount =  User::all()->count();
        $equipmentCount =  EquipmentItem::all()->count();
        $equipmentTypeCount =  EquipmentType::all()->count();

        return view('backend.dashboard', compact('userCount', 'equipmentCount', 'equipmentTypeCount'));
    }
}
