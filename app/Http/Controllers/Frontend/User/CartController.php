<?php  

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Models\ComponentItem;

/**
 * Class CartController.
 */
class CartController 
{
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function index()
    {
        $componentItem = ComponentItem::all();
        return view('frontend.user.products', compact('componentItem'));
    }    

    public function cart()
    {
        return view('frontend.user.cart');
    }

}