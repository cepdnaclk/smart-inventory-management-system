<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('componentItems')->get();
        try {
            return response()->json($orders,200);
        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
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
            return response()->json($order,200);

        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try 
        {
            $order = Order::with('componentItems')->find($id);
            if($order!=null)
            {
                return response()->json($order,200);
            }
            else
            {
                return response()->json(["message"=>"Order is not found!"],404);
            }
        }
        catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request()->validate([
            'ordered_date' => 'string|required',
            'picked_date' => 'string|nullable', // TODO: Validate properly
            'due_date_to_return' => 'string|required',
            'returned_date' => 'string|nullable',
            'status' => 'string|required',
        ]);

        try {
            $order  = Order::find($id);
            if($order ==null){
                return response()->json(["message"=>"Order is not found!"],404);
            }
            $order->update($data);
            return response()->json($order,200);

        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            if($order==null){
                return response()->json([
                    "message"=>"Type is not found"
                ],404);
            }
            
            $order->delete();
            return response()->json($order,200);

        } catch (\Exception $ex) {
            return response()->json([
                "message"=>$ex->getMessage()
            ],500);
        }
    }
}
