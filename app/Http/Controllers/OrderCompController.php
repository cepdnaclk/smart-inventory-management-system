<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComponentItem;
use App\Models\ComponentType;

class OrderCompController extends Controller
{
    //
    public function orderComponent(ComponentItem $componentItem)
    {
        return view('frontend.user.ordercomp', compact('componentItem'));
    }
}
