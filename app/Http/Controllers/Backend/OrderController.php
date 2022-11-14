<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Models\OrderApproval;
use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;

use App\Mail\Backend\OrderMail;
use App\Models\Locker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\True_;

use App\Mail\Orders\OrderRejectMailForHOD;
use App\Mail\Orders\OrderApproveMailForHOD;
use App\Mail\Orders\OrderRejectMailForLecturer;
use App\Mail\Orders\OrderApproveMailForLecturer;
use App\Mail\Orders\OrderMailForTechnicalOfficer;


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
        $lecturers = User::where('type', 'lecturer')->get();

        return view('backend.orders.edit', compact('order', 'lecturers'));
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

            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.orders.index')->with('Success', 'Order was deleted !');
            } else {
                return view('frontend.user.cart');
            }
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function lecturer_index()
    {
        $id = auth()->user()->id;
        $user = User::where('id', $id);
        if (auth()->user()->isAdmin()) {
            $orderApproval = OrderApproval::where('is_approved_by_lecturer', '=', null)->get();
        } else {
            $orderApproval = OrderApproval::where('lecturer_id', \Auth::user()->id)->where('is_approved_by_lecturer', '=', null)->get();
        }

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
        $availableLockers = Locker::getAvailableLockers()->pluck('id', 'id');

        if ($orderRequest->status == 'APPROVED') {
            return view('backend.orders.technical-officer.approved.confirm', compact('orderRequest', 'availableLockers'));
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
                "title" => "Your Order Request- " . $orderRequest->id . " is READY !",
                "body"  =>  "Your order is ready to pickup.
                            Please visit the MakerSpace and collect it.
                            These are your components",
                "url"   => route('frontend.user.orders.index'),

                "components" => $orderRequest->componentItems
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
                "title" => "Your Order Request- " . $orderRequest->id . " is HANDED OVER !",
                "body"  =>  "You collected your order- " . $orderRequest->id . " on " . $orderRequest->picked_date .
                    " at CE Smart Inventory MakerSpace.
                            These are the components",
                "url"   => route('frontend.user.orders.index'),

                "components" => $orderRequest->componentItems
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
                "title" => "Your Order Request- " . $orderRequest->id . " is SUMBMITTED !",
                "body"  =>  "You returned your order- " . $orderRequest->id . " on " . $orderRequest->returned_date .
                    " at CE Smart Inventory MakerSpace.
                            These are the components",
                "url"   => route('frontend.user.orders.index'),

                "components" => $orderRequest->componentItems
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
        //dd(route('admin.orders.lecturer.index'));
        // Send an email to the HOD
        try {
            $details = [
                "title" => "Order Request for Head Of The Department Approvel !",
                "body"  =>  "This team place an order with this components and " . $order->orderApprovals->lecturer['name'] .
                    " approve the request. Can you kindly future give premission to release the request components to user.",
                "url"   => route('admin.orders.h_o_d.index'),

                "components" => $order->componentItems
            ];
            //Mail::to($order->HOD->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($details));

            return redirect()->route('admin.orders.lecturer.index')->with('success', 'you have approved the order.you can view the order in accepted order list.');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }

    public function lecturer_reject(Order $order)
    {
        //to update the accepted table 
        $order->orderApprovals->is_approved_by_lecturer = 0;
        $order->status = "REJECTED";
        $order->orderApprovals->save();
        $order->save();

        // Send an email to the student
        try {
            $details = [
                "title" => "Order Request rejected by Lecturer",
                "body"  => "Your order request is rejected by " . $order->orderApprovals->lecturer['name'] . " These are the components.",

                "url"   => route('frontend.user.orders.index'),

                "components" => $order->componentItems

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
        if (auth()->user()->isAdmin()) {
            $orderApproval = OrderApproval::where('is_approved_by_lecturer', '=', 1)->get();
        } else {
            $orderApproval = OrderApproval::where('lecturer_id', $id)->where('is_approved_by_lecturer', '=', 1)->get();
        }
        //return response()->json($orderApproval, 200);

        return view('backend.orders.lecturer.accepted.index', compact('orderApproval'));
    }

    public function lecturer_rejected_index()
    {

        $id = auth()->user()->id;
        if (auth()->user()->isAdmin()) {
            $orderApproval = OrderApproval::where('is_approved_by_lecturer', '=', 0)->get();
        } else {
            $orderApproval = OrderApproval::where('lecturer_id', $id)->where('is_approved_by_lecturer', '=', 0)->get();
        }
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
            $msgForStudent = [
                "title" => "Your Order Request is Approved by Head of the Department.",
                "body" =>  "you will get some update about availability soon",
                "url"   => route('frontend.user.orders.index'),

                "components" => $order->componentItems
            ];

            //Mail::to($order->user->email)->send(new OrderMail($details));
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($msgForStudent));

            $msgForOfficer = [
                "title" => "New Order Request From CE Smart Inventory",
                "body"  =>  $order->user->name . " make an order for this components.
                            Can you please visit the dashboard and prepare and release to them",
                "url"   => route('admin.orders.officer.approved.index'),

                "components" => $order->componentItems
            ];

            //send mail to all tech officers
            $officers = User::where('type', 'tech_officer')->orderBy('id')->get();
            // foreach ($officers as $officer) {
            //     Mail::to($officer->email)->send(new OrderMail($msgForOfficer));
            // }
            Mail::to("e18115@eng.pdn.ac.lk")->send(new OrderMail($msgForOfficer));

            return redirect()->route('admin.orders.h_o_d.index')->with('success', 'you have approved the order. you can view the order in accepted order list.');
        } catch (\Exception $ex) {
            return abort(500);
        }
    }


    public function h_o_d_reject(Order $order)
    {
        //to update the accepted table 
        $order->orderApprovals->is_approved_by_lecturer = 1;

        $order->status = "REJECTED";
        $order->save();
        $order->orderApprovals->save();

        // Send an email to the student
        try {
            $details = [
                "title" => "Order Request rejected by Head of the Department",
                "body"  => "These are the components.",

                "url"   => route('frontend.user.orders.index'),

                "components" => $order->componentItems

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



        $orders = Order::where('status', 'APPROVED')->get();
        //return response()->json($orderApproval, 200);

        return view('backend.orders.hod.accepted.index', compact('orders'));
    }

    public function h_o_d_rejected_index()
    {


        $orderApproval = OrderApproval::where('is_approved_by_lecturer', '=', 1)->get();

        //return response()->json($orderApproval, 200);

        return view('backend.orders.hod.rejected.index', compact('orderApproval'));
    }
}
