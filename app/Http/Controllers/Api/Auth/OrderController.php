<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
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
        try {
            $orders = auth('api')->user()->orders;
            return response()->json($orders,200);
            
        } catch (\Exception $ex) {
            return response()->json(["message"=>$ex->getMessage()],500);
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
        $order = auth('api')->user()->orders->find($id);
        if ($order==null)
		    return response()->json(['message'=>'Not found'],404);
        else
            return response()->json($order,200);
    }
}
