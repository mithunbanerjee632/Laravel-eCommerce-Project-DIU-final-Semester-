<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\VisitorModel;

class HomeController extends Controller
{
    function HomePage(){

        $UserIp =$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $TimeDate = date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIp,'visit_time'=>$TimeDate]);


        $products = ProductModel::orderby('id','asc')->limit(6)->get();
        return view('Frontend.Pages.Home',['products'=>$products])/*->with('products',$products)*/;

        /*$SalesData = json_decode(ProductModel::orderby('id','desc')->get());
        return view('Home',['SalesData'=>$SalesData]);*/
    }
}
