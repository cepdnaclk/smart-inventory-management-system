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

    public function addToCart($id)
    {
        $componentItem = ComponentItem::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) 
        {
            $cart[$id]['quantity']++;
        } 
        else 
        {
            $cart[$id] = [
                "name" => $componentItem->title,
                "quantity" => 1,                
                "image" => $componentItem->image
            ];
        }          

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

}