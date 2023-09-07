<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Address;

class OrdersController extends Controller
{
    public function index(){
        // $orders = Order::all()->unique('order_num')->toArray();
        $payments = Payment::where('status',1)->with(['orders','address','orders.user'])->orderBy('created_at','desc')->get();
//        dd($payments);
        return view('Admin.Orders.index',compact('payments'));
    }
//     public function orderview($orderid){
//         $orders = Order::where('order_num',$orderid)->with('product')->get();
//         $payment = Payment::where('order_num',$orderid)->first();
//         $address = Address::where('order_num',$orderid)->first();
//         return view('Admin.Orders.orderdetail',compact('orders','payment','address','orderid'));
//     }
    public function orderupdate(Request $request){
        // return $request->all();
        $order = Order::where('order_num',$request->order_num)->first();
        if($request->status == 1){
                $order->status = 2;
        }elseif($request->status  == 2){
                $order->status = 3;
        }elseif($request->status == 3){
                $order->status = 1;
        }else{
                return response()->json(['error' => 'something went wrong']);
        }
        $order->update();
        return response()->json(['success'=>'successfully updated Status']);
    }
}
