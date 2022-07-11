<?php

namespace App\Http\Controllers\Frontend\User;

use Mail;
use App\Models\Order;
use App\Mail\OrderRequest;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\OrderApproval;

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
        
        return response()->json(  $order->orderApprovals);
      
        
      
  
        return redirect()->back()->withSuccess('Email has been sent');
        return response()->json($order);




       


        


     }
}
