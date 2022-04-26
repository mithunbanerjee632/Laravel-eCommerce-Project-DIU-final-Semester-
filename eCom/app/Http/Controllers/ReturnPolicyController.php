<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnPolicyController extends Controller
{
   function ReturnPolicyPage(){
       return view('Frontend.Pages.ReturnPolicy');
   }
}
