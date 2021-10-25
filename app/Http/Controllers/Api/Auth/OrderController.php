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
            $orders = auth('api')->user()->orders()->with('componentItems')->get();
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
        $order = auth('api')->user()->orders()->with('componentItems')->find($id);
        if ($order==null)
		    return response()->json(['message'=>'Not found'],404);
        else
            return response()->json($order,200);
    }


    /**
     * set and return the otp for a order.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestOtp($orderId)
    {
        try {
            $order = auth('api')->user()->orders->find($orderId);
            if($order!=null){
                $otp = $order->generateOtp();
                return response()->json($otp,200);
            }
            else{
                return response()->json(['message'=>'Not found'],404);
            }
            
        } catch (\Exception $ex) {
            return response()->json(["message"=>$ex->getMessage()],500);
        }
    }

    /**
     * set and return the otp for a order.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkOtp($orderId,$otp)
    {
        try {
            $order = auth('api')->user()->orders->find($orderId);
            if($order!=null){
                $res = $order->checkOtp($otp);
                return response()->json($res,200);
            }
            else{
                return response()->json(['message'=>'Not found'],404);
            }
            
        } catch (\Exception $ex) {
            return response()->json(["message"=>$ex->getMessage()],500);
        }
    }
}
