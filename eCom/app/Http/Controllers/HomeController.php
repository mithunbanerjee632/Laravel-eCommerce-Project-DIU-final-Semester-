<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesModel;

class HomeController extends Controller
{
    function HomePage(){

        $SalesData = json_decode(SalesModel::all());
        return view('Home',['SalesData'=>$SalesData]);
    }
}
