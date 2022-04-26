<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    function AboutPage(){
        return view('Frontend.Pages.About');
    }
}
