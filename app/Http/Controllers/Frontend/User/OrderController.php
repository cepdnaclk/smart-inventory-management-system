<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Order;
use App\Mail\OrderRequest;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Mail\Frontend\OrderMail;
use App\Mail\OrderMailForUsers;
use App\Mail\Orders\OrderRequestMailForUsers;
use App\Models\OrderApproval;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('frontend.orders.show', compact('order'));
    }
    public function index(){
        $id = auth()->user()->id; //getting current user id 
        $orders=Order::where('user_id',$id)->get();
        $orders=$orders->reverse();
    
       return view('frontend.orders.index', compact('orders'));
    
     }
     public function store(Request $request){
 
     //dd($request->OrderID);
        $request->validate(['name'=>'required','enumber'=>'required','expected_date'=>'required','description'=>'required','selectLecturer'=>'required']);
     
        $id=$request->OrderID;
        $order=Order::where('id',$id)->first();
        $orderApproval=new OrderApproval();
        
        

        
       
        $select_lecturerId=User::where('type','lecturer')->where('name',$request->selectLecturer)->first();
        $orderApproval->lecturer_id=$select_lecturerId->id;
        $orderApproval->order_id=$order->id;
     
        $orderApproval->save();
       
        $order->description=$request->description;
        $order->expected_date=$request->expected_date;
      
  
     
   
        $order->save();
        $cart = session()->get('cart', []);
        if ($cart != null)
        $cart = [];
        session()->put('cart', $cart);
        
        try {
            $msgForLecture = [
                "title" => "New Order Request From CE Smart Inventory",
                "body"  =>  $order->user->name . " make a request to receive this components.
                            Can you please visit the dashboard and approve it.",
                "url"   => "http://127.0.0.1:8000/login",

                "components" => $order->componentItems

            ];
            //Mail::to($orderApproval->lecturer['email'])->send(new OrderMail($msgForLecture));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($msgForLecture));

            $msgForStudent = [
                "title" => "Your Order Request From CE Smart Inventory",
                "body"  => "You made order request with this components in CE Smart Inventory.
                            your order request is waiting for lecturer approvel.",
                "url"   => "http://127.0.0.1:8000/login",

                "components" => $order->componentItems
            ];
            //Mail::to($order->user->email)->send(new OrderMail($msgForStudent));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($msgForStudent));
            
            return redirect()->route('frontend.user.products')->with('success', 'Order Request mail has been sent sucessfully.');
            
        } catch (\Exception $ex) {
            return abort(500);
        }
    }
}
