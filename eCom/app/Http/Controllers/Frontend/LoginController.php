<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class LoginController extends Controller
{
   function LoginPage(){
       return view('Login');
   }
}
