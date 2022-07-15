<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Order;
use App\Mail\OrderRequest;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
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
        return view('frontend.mails.student_order_mail', compact('order'));
    }

    public function mail(Request $request)
    {   
        $data = request()->validate([
            'email' => 'required|email',
            'body' => 'required|string',
        ]);
        
        try {
            Mail::to($data['email'])->send(new OrderRequestMailForUsers($data));
            return redirect()->route('frontend.user.products')->with('success', 'Order Request mail has been sent sucessfully.');
        
        } catch (\Exception $ex) {
            return abort(500);
        }
    }
}