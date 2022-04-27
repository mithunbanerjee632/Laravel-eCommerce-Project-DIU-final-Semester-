<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class RegisterController extends Controller
{
    function RegistrationPage(){
        return view('Register');
    }
}
