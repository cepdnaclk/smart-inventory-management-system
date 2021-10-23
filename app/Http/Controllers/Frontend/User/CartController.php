<?php  

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\ComponentItem;
use App\Models\Order;
use App\Models\ComponentItemOrder;
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
                "code" => $componentItem->id,              
                "image" => $componentItem->image
            ];
        }          

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id)
        {
            $cart = session()->get('cart');
            if(isset($cart[$request->id]))
            {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }   
    }

    public function placeOrder(Request $request)
    {
        $date = Carbon::now();
        $order_id = 600;
        
            $order = new Order;
            $order->id = $order_id ;
            $order->ordered_date = $date->toDateString();
            $order->status = "pending";            
            $order->user_id =  Auth::user()->id;            
            $order->save();

        foreach($request->product as $item)
        {
            $componentItemOrder = new ComponentItemOrder;
                    
            $componentItemOrder->quantity = 10;
            $componentItemOrder->component_item_id = $item;
            $componentItemOrder->order_id =  $order_id;            
            $componentItemOrder->save();
        }
                    
        return $request->all();
    }    

}