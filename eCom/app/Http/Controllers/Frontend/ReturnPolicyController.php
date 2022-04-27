<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class ReturnPolicyController extends Controller
{
   function ReturnPolicyPage(){
       return view('Frontend.Pages.ReturnPolicy');
   }
}
