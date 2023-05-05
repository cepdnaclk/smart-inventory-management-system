<?php

namespace App\Http\Controllers;

use App\Models\ComponentItem;

class OrderCompController extends Controller
{
    //
    public function orderComponent(ComponentItem $componentItem)
    {
        return view('frontend.user.ordercomp', compact('componentItem'));
    }
}
