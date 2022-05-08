<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
/*use Barryvdh\DomPDF\Facade\Pdf;*/
use PDF;

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

    function ChargeUpdate(Request $request,$id){

        $order = Order::find($id);
         $order->shipping_charge = $request->shipping_charge;
         $order->custom_discount = $request->custom_discount;
        $order->save();
        session()->flash('success','Order Shipping Charge and Custom Discount Has Changed Changed...');
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

    function generateInvoice($id){
        $order = Order::find($id);
       // return view('backend.pages.Orders.Invoice', compact('order'));
        $pdf = PDF::loadView('backend.pages.Orders.Invoice', compact('order'));

        return $pdf->stream('invoice.pdf');
        //return $pdf->download('invoice.pdf');
    }

}

