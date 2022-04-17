<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailsController extends Controller
{
    function DetailsPage(){
        return view('Details');
    }
}
