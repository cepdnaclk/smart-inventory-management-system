<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use App\Http\Controllers\Controller;
use App\Mail\Backend\OrderMail;
use App\Models\Locker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\True_;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::paginate(12);
        return view('backend.orders.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $types = Order::pluck('title', 'id');
        return view('backend.orders.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'picked_date' => 'date|nullable', // TODO: Validate properly
            'due_date_to_return' => 'date|required', // TODO: Validate properly
            'returned_date' => 'date|nullable', // TODO: Validate properly
            'status' => 'string|required',
        ]);

        try {
            $data['ordered_date'] = Carbon::now()->format('Y-m-d');
            $data['user_id'] = $request->user()->id;
            $order = new Order($data);
            $order->save();
            return redirect()->route('admin.orders.index')->with('Success', 'Order was created !');

        } catch (\Exception $ex) {
            return abort(500, "Error 222");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Order $order)
    {
        return view('backend.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Order $order)
    {
        return view('backend.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, Order $order)
    {
        $data = request()->validate([
            'ordered_date' => 'date|required', // TODO: Validate properly
            'picked_date' => 'date|nullable', // TODO: Validate properly
            'due_date_to_return' => 'date|required', // TODO: Validate properly
            'returned_date' => 'date|nullable', // TODO: Validate properly
            'status' => 'string|required',
        ]);

        try {
            $order->update($data);
            return redirect()->route('admin.orders.index')->with('Success', 'Order was updated !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    /**
     * Confirm to delete the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function delete(Order $order)
    {
        return view('backend.orders.delete', compact('order'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return redirect()->route('admin.orders.index')->with('Success', 'Order was deleted !');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function lecturer_index()
    {
        $id = auth()->user()->id;

        $orderApproval = OrderApproval::where('lecturer_id', \Auth::user()->id)->where('is_approved_by_lecturer', '=', null)->get();
        //return response()->json($orderApproval, 200);

        return view('backend.orders.lecturer.index', compact('orderApproval'));
    }
    public function h_o_d_index()
    {
     

        $orderApproval = OrderApproval::where('is_approved_by_lecturer', '=', 1)->get();
        //return response()->json($orderApproval, 200);

        return view('backend.orders.hod.request.index', compact('orderApproval'));
    }


    public function lecturer_show(Order $order)
    {
        return view('backend.orders.lecturer.show', compact('order'));
    }
    public function h_o_d_show(Order $order)
    {
        return view('backend.orders.hod.show', compact('order'));
    }

    //---------------------------------------------------------------------------------------------------------------------------------------
    //technical-officer

    //index
    public function officer_index()
    {
        return view('backend.orders.technical-officer.index');
    }

    //approved orders
    public function officer_index_for_approved_orders()
    {
        $orderRequests = Order::getApprovedOrders();

        return view('backend.orders.technical-officer.approved.index', compact('orderRequests'));
    }

    //ready orders
    public function officer_index_for_ready_orders()
    {
        $orderRequests = Order::getReadyOrders();

        return view('backend.orders.technical-officer.ready.index', compact('orderRequests'));
    }

    //picked orders
    public function officer_index_for_picked_orders()
    {
        $orderRequests = Order::getPickedOrders();

        return view('backend.orders.technical-officer.picked.index', compact('orderRequests'));
    }

    public function officer_show(Order $orderRequest)
    {
        return view('backend.orders.technical-officer.show', compact('orderRequest'));
    }

    public function officer_confirm_for_approved_orders(Order $orderRequest)
    {   
        $availableLockers = Locker::getAvailableLockers()->pluck('id','id');

        if ($orderRequest->status == 'APPROVED') {
            return view('backend.orders.technical-officer.approved.confirm', compact('orderRequest','availableLockers'));
        } else {
            $id = $orderRequest->id;
            return redirect()->route('admin.orders.officer.approved.index')->with('Success', 'The Order request #' . $id . ' already ready !');
        }
    }

    public function officer_confirm_for_ready_orders(Order $orderRequest)
    {   
        if ($orderRequest->status == 'READY') {
            return view('backend.orders.technical-officer.ready.confirm', compact('orderRequest'));
        } else {
            $id = $orderRequest->id;
            return redirect()->route('admin.orders.officer.ready.index')->with('Success', 'The Order request #' . $id . ' already handed over !');
        }
    }

    public function officer_confirm_for_picked_orders(Order $orderRequest)
    {
        if ($orderRequest->status == 'PICKED') {
            return view('backend.orders.technical-officer.picked.confirm', compact('orderRequest'));
        } else {
            $id = $orderRequest->id;
            return redirect()->route('admin.orders.officer.picked.index')->with('Success', 'The Order request #' . $id . ' already finished !');
        }
    }

    public function officer_ready(Request $request, Order $orderRequest)
    {
        $data = request()->validate([
            'locker_id' => 'numeric|required',
            'due_date_to_return' => 'date|required',
        ]);

        $orderRequest->update($data);

        // Update the status
        $orderRequest->status = 'READY';
        $orderRequest->save();

        //Update Locker isAvailable field
        $orderRequest->locker->is_available = false;
        $orderRequest->locker->save();
        
        //update technical officer id who ready this oder
        $orderRequest->orderApprovals->technical_officer_id = auth()->user()->id;
        $orderRequest->orderApprovals->save();

        // Send an email to the student
        try {
            $details = [
                "title" => "your order request is ready.",
                "body"  => "you can collect your order at CE Smart Inventory."
            ];
            //Mail::to($orderRequest->user->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));

            return redirect()->route('admin.orders.officer.approved.index')->with('Success', 'Email has been sent!');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function officer_picked(Order $orderRequest)
    {
        $data = request()->validate([
            'picked_date' => 'date|required',
        ]);

        $orderRequest->update($data);

        // Update the status
        $orderRequest->status = 'PICKED';
        $orderRequest->save();

        //Update Locker isAvailable field
        $orderRequest->locker->is_available = true;
        $orderRequest->locker->save();
        
        // Send an email to the student
        try {
            $details = [
                "title" => "your order request is picked.",
                "body"  => "your submitted order components are correct."
            ];
            //Mail::to($orderRequest->user->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));

            return redirect()->route('admin.orders.officer.ready.index')->with('Success', 'Email has been sent!');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function officer_finish(Order $orderRequest)
    {
        $data = request()->validate([
            'returned_date' => 'date|required',
        ]);

        $orderRequest->update($data);

        // Update the status
        $orderRequest->status = 'FINISHED';
        $orderRequest->save();

        //TODO
        //do we want to change componets count in this phase

        // Send an email to the student
        try {
            $details = [
                "title" => "your order request is finished.",
                "body"  => "your submitted order components are correct."
            ];
            //Mail::to($orderRequest->user->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));

            return redirect()->route('admin.orders.officer.picked.index')->with('Success', 'Email has been sent!');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

//---------------------------------------------------------------------------------------------------------------------------------------
    


    public function lecturer_approve(Order $order)
    {
        //to update the accepted table 
        $order->orderApprovals->is_approved_by_lecturer = 1;
        $order->status = "WAITING_H_O_D_APPROVAL";
        $order->orderApprovals->save();
        $order->save();

        // Send an email to the HOD
        try {
            $details = [
                "title" => "your order request is approved by lecturer",
                "body" =>""
            ];
            //Mail::to($order->HOD->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));
            
            return redirect()->route('admin.orders.lecturer.index')->with('success', 'you have approved the order.you can view the order in rejected order list.');

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function lecturer_reject(Order $order)
    {
        //to update the accepted table 
        $order->orderApprovals->is_approved_by_lecturer=0;
        $order->status="REJECTED";
        $order->orderApprovals->save();
        $order->save();

        // Send an email to the student
        try {
            $details = [
                "title" => "your order request is rejected by lecturer",
                "body"  => ""
            ];
            //Mail::to($order->user->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));

            return redirect()->route('admin.orders.lecturer.index')->with('success', 'you have rejected the order.you can view the order in rejected order list.');
            
        } catch (\Exception $ex) {
            return abort(500);
        }
        
    }

    public function lecturer_accepted_index()
    {

        $id = auth()->user()->id;

        $orderApproval = OrderApproval::where('lecturer_id', $id)->where('is_approved_by_lecturer', '=', 1)->get();
        //return response()->json($orderApproval, 200);

        return view('backend.orders.lecturer.accepted.index', compact('orderApproval'));
    }

    public function lecturer_rejected_index()
    {
      
        $id = auth()->user()->id;
    
        $orderApproval=OrderApproval::where('lecturer_id',$id)->where('is_approved_by_lecturer', '=', 0)->get();
        //return response()->json($orderApproval, 200);
      
        return view('backend.orders.lecturer.rejected.index', compact('orderApproval'));
    }

    
    
    public function h_o_d_approve(Order $order)
    {   
        //to update the accepted table 
        
        $order->status = "APPROVED";
        
        $order->save();
        
        // Send an email to the student
        try {
            $details = [
                "title" => "your order request is approved by Head of the Department",
                "body" =>""
            ];
            //Mail::to($order->user->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));

            return redirect()->route('admin.orders.h_o_d.index')->with('success', 'you have approved the order. you can view the order in accepted order list.');
            
        } catch (\Exception $ex) {
            return abort(500);
        }
    }


    public function h_o_d_reject(Order $order)
    {   
        //to update the accepted table 
        $order->orderApprovals->is_approved_by_lecturer=1;

        $order->status ="REJECTED";
        $order->save();
        $order->orderApprovals->save();

        // Send an email to the student
        try {
            $details = [
                "title" => "your order request is rejected by Head of the Department",
                "body" =>""
            ];
            //Mail::to($order->user->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));

            return redirect()->route('admin.orders.h_o_d.index')->with('success', 'you have rejected the order.you can view the order in rejected order list.');
            
        } catch (\Exception $ex) {
            return abort(500);
        }
        
    }

    
    public function h_o_d_accepted_index()
    {

     

        $orders = Order::where('status', 'WAITING_TECHNICAL_OFFICER_APPROVAL')->get();
        //return response()->json($orderApproval, 200);

        return view('backend.orders.hod.accepted.index', compact('orders'));
    }

    public function h_o_d_rejected_index()
    {
      
    
        $orderApproval=OrderApproval::where('is_approved_by_lecturer', '=', 1)->get();

        //return response()->json($orderApproval, 200);
      
        return view('backend.orders.hod.rejected.index', compact('orderApproval'));
    }

}
