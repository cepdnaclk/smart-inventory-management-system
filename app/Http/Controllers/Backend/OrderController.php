<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Order::pluck('title', 'id');
        return view('backend.orders.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([

            'picked_date' => 'string|nullable', // TODO: Validate properly
            'due_date_to_return' => 'string|required',
            'returned_date' => 'string|nullable',
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('backend.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('backend.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = request()->validate([
            'ordered_date' => 'string|required',
            'picked_date' => 'string|nullable', // TODO: Validate properly
            'due_date_to_return' => 'string|required',
            'returned_date' => 'string|nullable',
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
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
}
