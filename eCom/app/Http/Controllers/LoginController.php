<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
   function LoginPage(){
       return view('Login');
   }
}
