<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Order;
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
        return view('frontend.user.overview');
    }
}
