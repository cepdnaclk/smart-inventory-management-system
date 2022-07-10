<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderRequest;
use Mail;

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
        
        $order->description=$request->description;
        $order->expected_date=$request->expected_date;
        $order->save(); 
      
        
      Mail::to('rasathuraikaran26@gmail.com')->send(new OrderRequest());
      
        return response()->json($order);
        return redirect()->back()->withSuccess('Email has been sent');
        return response()->json($order);




       


        


     }
}
