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
     public function update(Request $request,Order $order){
        $data =  request()->validate(['description'=>'string','selectLecturer'=>'string']);
        try {



            $select_lecturerId=User::where('type','lecturer')->where('name',$request->selectLecturer)->first();
            $order->orderApprovals->lecturer_id=$select_lecturerId->id;
            $order->orderApprovals->order_id=$order->id;

            $order-> description=$request->input('description');

            $order->save();
            $order->orderApprovals->save();
            //$order->update();
            $id = auth()->user()->id; //getting current user id 
            $orders=Order::where('user_id',$id)->get();
            $orders=$orders->reverse();
            return view('frontend.orders.index', compact('orders'))->with('success', 'locker was updated !');

            //return view('frontend.orders.show', compact('order'));

         // return redirect()->route('frontend.orders.index')->with('Success', 'locker was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
      

    
     }

     public function edit(Order $order){
       // return response()->json($order->orderApprovals->lecturer, 200);

        $lecturers=User::where('type','lecturer')->get();

        return view('frontend.orders.edit', compact('order','lecturers'));
     }
     public function store(Request $request){
 
     //dd($request->OrderID);
        $request->validate(['name'=>'required|string','enumber'=>'required','expected_date'=>'required','description'=>'required|string','selectLecturer'=>'required']);
  
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
            $details = [
                "title" => "Your Order has been sent succesfully  ",
                "body"  => "Please wait for  selected lecturer approval!!."
            ];
            //Mail::to($orderApproval->lecturer['email'])->send(new OrderMail($details));
            Mail::to("e18168@eng.pdn.ac.lk")->send(new OrderMail($details));
            
            return redirect()->route('frontend.user.products')->with('success', 'Order Request mail has been sent sucessfully.');
            
        } catch (\Exception $ex) {
            return abort(500);
        }
    }
    public function change_status(Order $order){
        $order->status="PICKED";
        $order->update();
       
               return redirect()->route('frontend.user.orders.index')->with('Success', 'Status was updated !');

    }
}
