<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
   function CartPage(){
       return view('Frontend.Pages.Cart');
   }
}
