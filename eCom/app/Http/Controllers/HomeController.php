<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesModel;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    function HomePage(){

        $UserIp =$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $TimeDate = date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIp,'visit_time'=>$TimeDate]);




        /*$SalesData = json_decode(SalesModel::all());
        return view('Home',['SalesData'=>$SalesData]);*/
    }
}
