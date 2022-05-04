<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function view;
use App\Models\Division;
use App\Models\District;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;

use Auth;

class CheckoutController extends Controller
{
   function CheckoutPage(){
       $divisions =Division::orderby('priority','asc')->get();
       $districts = District::orderby('division_id','asc')->get();
       $payments = Payment::orderby('priority','asc')->get();
       $user = Auth::user();
       return view('Frontend.Pages.Checkout',compact('user','divisions','districts','payments'));
   }

   function CheckoutStore(Request $request){


      $order = new Order();

     if($request->payment_method_id != 'cash_in'){
          if($request->transaction_id == NULL || empty($request->transaction_id) ){
             session()->flash('sticky_error','Please Give Your Payment Transaction Id');
             return back();
          }
      }

      $order->name = $request->name;
        $order->email = $request->email;
        $order->phone_no = $request->phone_no;
    $order->shipping_address = $request->shipping_address;
         $order->division_id = $request->division_id;
          $order->district_id = $request->district_id;
         $order->zipcode = $request->zipcode;
          $order->message = $request->message;
         $order->ip_address = $request->ip();
         $order->transaction_id = $request->transaction_id;


           if(Auth::check()){
                 $order->user_id = Auth::user()->id;

             }


            $order->payment_id = Payment::where('short_name',$request->payment_method_id)->first()->id;
             $order->save();

             foreach(Cart::totalCarts() as $cart){
                $cart->order_id = $order->id;
                $cart->save();
             }

              session()->flash('success','Your Order is Placed Successfully! Please Wait admin will Confirm it.');
              return redirect('/');

   }


}
