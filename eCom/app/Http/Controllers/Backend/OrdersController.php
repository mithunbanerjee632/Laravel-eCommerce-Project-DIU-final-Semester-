<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    function OrderPage(){


     $orders = Order::orderby('id','desc')->get();
        return view('backend.pages.Orders.OrderPage',compact('orders'));




    }

    function OrderShow($id){
       $order = Order::find($id);
       $order->is_seen_by_admin =1;
       $order->save();
        return view('backend.pages.orders.OrderShow',compact('order'));

    }

    function OrderDelete($id){

    }

    function OrderComplete($id){

       $order = Order::find($id);
       if($order->is_completed){
           $order->is_completed = 0;
       }else{
           $order->is_completed = 1;
       }
       $order->save();
       session()->flash('success','Order Completed Status Changed...');
       return back();
    }

    function OrderPaid($id){
        $order = Order::find($id);
        if($order->is_paid){
            $order->is_paid = 0;
        }else{
            $order->is_paid = 1;
        }
        $order->save();
        session()->flash('success','Order Paid Status Changed...');
        return back();
    }
}

