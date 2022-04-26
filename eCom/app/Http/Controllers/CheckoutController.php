<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   function CheckoutPage(){
       return view('Frontend.Pages.Checkout');
   }
}
