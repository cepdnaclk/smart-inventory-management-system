<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $tech_officer_id = auth()->user()->id;
        //dd(\Auth::user()->id);

        $orderApprovals = OrderApproval::where('technical_officer_id', $tech_officer_id)->where('is_approved_by_lecturer', '=', 1)->get();

        //$o_id = $orderApprovals -> order_id;
        //dd($orderApprovals);

        return view('backend.orders.technical-officer.index', compact('orderApprovals'));
    }

    // public function officer_show(JobRequests $jobRequests)
    // {
    //     return view('backend.jobs.technical-officer.show', compact('jobRequests'));
    // }

    // public function supervisor_approve(JobRequests $jobRequests)
    // {
    //     dd('Approved');
    //     // TODO: The logic to be implemented
    //     // Send an email to the student
    //     // Send an email to the TO
    //     // Update the status into 'PENDING_FABRICATION'
    //     // Update timestamp details
    //     return redirect()->route('admin.jobs.supervisor.index');
    // }

    // public function supervisor_reject(JobRequests $jobRequests)
    // {
    //     dd('Rejected');
    //     // TODO: The logic to be implemented
    //     // Send an email to the student
    //     // Update the status into 'NOT_APPROVED'
    //     // Update timestamp details
    //     return redirect()->route('admin.jobs.supervisor.index');
    // }

    // public function officer_finish(JobRequests $jobRequests)
    // {
    //     dd("Finished");
    //     // TODO: Finish the job
    //     // Send emails to Student and Lecturer about the finish notice
    //     // Update machine timed, material usage, etc...
    //     return redirect()->route('admin.jobs.officer.index');
    // }


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
