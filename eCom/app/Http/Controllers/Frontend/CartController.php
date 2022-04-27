<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cart;

use App\Models\Order;


/*use Illuminate\Support\Facades\Auth;*/
use function view;
use Auth;

class CartController extends Controller
{
   function CartPage(){
       return view('Frontend.Pages.Cart');
   }

   function CartStore(Request $request){
       $this->validate($request,[
           'product_id'=>'required'
           ],
       [
           'product_id.required'=>'Please give a Product'
       ]);

       if(Auth::check()){
           $cart = Cart::Where('user_id',Auth::id())
               ->where('product_id',$request->product_id)
               ->first();
       }else{
           $cart = Cart::Where('ip_address',request()->ip())
               ->where('product_id',$request->product_id)
               ->first();
       }

       if(!is_null($cart)){
           $cart->increment('product_quantity');
       }else{
           $cart = new Cart();
           if(Auth::check()){
               $cart->user_id =Auth::id();
           }

           $cart->ip_address = request()->ip();
           $cart->product_id = $request->product_id;
           /* $cart->product_quantity = $request->product_quantity;*/
           $cart->save();

       }


       session()->flash('success','Product has added to Cart !!');
       return redirect('/CartPage');

   }

   function CartUpdate(Request $request,$id){
       $cart = Cart::find($id);

       if(!is_null($cart)){
           $cart->product_quantity = $request->product_quantity;
           $cart->save();
       }else{
           return redirect('/CartPage');
       }
       session()->flash('success','Cart Item is Updated Successfully!!');
       return back();
   }

   function CartDelete($id){
       $cart = Cart::find($id);
       if(!is_null($cart)){
           $cart->delete();
       }else{
           return redirect('/CartPage');
       }

       session()->flash('success','Cart Item is Deleted Successfully!!');
       return back();
   }
}
