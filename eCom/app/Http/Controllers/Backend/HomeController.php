<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    function HomeIndex(){
        return view('Backend.pages.Home');
    }
}
