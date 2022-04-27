<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class CheckoutController extends Controller
{
   function CheckoutPage(){
       return view('Frontend.Pages.Checkout');
   }
}
