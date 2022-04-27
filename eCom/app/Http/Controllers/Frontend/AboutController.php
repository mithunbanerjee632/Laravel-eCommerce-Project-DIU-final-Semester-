<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class AboutController extends Controller
{
    function AboutPage(){
        return view('Frontend.Pages.About');
    }
}
