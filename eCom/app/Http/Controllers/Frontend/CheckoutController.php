<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;
use App\Models\Division;
use App\Models\District;
use App\Models\Payment;
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


 /*  function CheckoutForm(){
        $divisions =Division::orderby('priority','asc')->get();
        $districts = District::orderby('division_id','asc')->get();
        $user = Auth::user();
        return view('Frontend.pages.Checkout',compact('user','divisions','districts'));
    }*/


  /* function UsersDetails(){
       $usr_details = Users::
   }*/
}
