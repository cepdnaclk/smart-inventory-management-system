<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use App\Http\Controllers\Controller;
use App\Models\Locker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TechnicalOfficerMail;

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

        $orderApproval = OrderApproval::where('lecturer_id', $id)->where('is_approved_by_lecturer', '=', 0)->get();
        //return response()->json($orderApproval, 200);

        return view('backend.orders.lecturer.index', compact('orderApproval'));
    }


    public function lecturer_show(Order $order)
    {
        return view('backend.orders.lecturer.show', compact('order'));
    }

    //---------------------------------------------------------------------------------------------------------------------------------------
    //technical-officer

    public function officer_index()
    {
        $approvedOrders = Order::getApprovedOrders();

        return view('backend.orders.technical-officer.index', compact('approvedOrders'));
    }

    public function officer_show(Order $approvedOrder)
    {
        return view('backend.orders.technical-officer.show', compact('approvedOrder'));
    }

    public function officer_confirm(Order $approvedOrder)
    {
        $availableLockers = Locker::getAvailableLockers()->pluck('id','id');
        if ($approvedOrder->status == 'APPROVED') {
            return view('backend.orders.technical-officer.confirm', compact('approvedOrder','availableLockers'));
        } else {
            $id = $approvedOrder->id;
            return redirect()->route('admin.orders.officer.index')->with('Success', 'The Order request #' . $id . ' already ready !');
        }
    }

    public function officer_ready(Request $request, Order $approvedOrder)
    {
        $data = request()->validate([
            'locker_id' => 'numeric|required',
            'due_date_to_return' => 'date|required',
        ]);

        try {
            $approvedOrder->update($data);

            // Change the status
            $approvedOrder->status = 'READY';
            $approvedOrder->save();

            //Update Locker isAvailable field
            $approvedOrder->locker->is_available = false;
            $approvedOrder->locker->save();
            
            return view('backend.orders.technical-officer.mail', compact('approvedOrder'));

        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function officer_mail(Request $request)
    {   $data = request()->validate([
            'email' => 'required|email',
            'body' => 'string|required',
        ]);

        Mail::to($data['email'])->send(new TechnicalOfficerMail($data));

        return redirect()->route('admin.orders.officer.index')->with('Success', 'Email has been sent!');
    }
    
    public function officer_finish(Order $approvedOrder)
    {
        dd("Finished");
        // TODO: Finish the order
        // Send emails to Student and Lecturer about the finish notice
        // Update machine timed, material usage, etc...
        return redirect()->route('admin.jobs.officer.index');
    }
//---------------------------------------------------------------------------------------------------------------------------------------
    


    public function lecturer_approve(Order $order)
    {
        //to update the accepted table 
        $order->orderApprovals->is_approved_by_lecturer = 1;
        $order->status = "WAITING_TECHNICAL_OFFICER_APPROVAL";
        $order->orderApprovals->save();
        $order->save();

        // TODO: The logic to be implemented
        // Send an email to the student
        // Send an email to the TO
        // Update the status into 'PENDING_FABRICATION'
        // Update timestamp details
        return redirect()->route('admin.orders.lecturer.index')->with('success', 'you have approved the order. you can view the order in accepted order list.');
    }


    public function lecturer_reject(Order $order)
    {
        //to update the accepted table 
        $order->orderApprovals->is_approved_by_lecturer=0;
        $order->status="REJECTED_BY_LECTURER";
        $order->orderApprovals->save();
        $order->save();


        // TODO: The logic to be implemented
        // Send an email to the student
        // Send an email to the TO
        // Update the status into 'PENDING_FABRICATION'
        // Update timestamp details
        return redirect()->route('admin.orders.lecturer.index')->with('success', 'you have approoved the order.you can view the order in accepted order list.');
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

    

}
