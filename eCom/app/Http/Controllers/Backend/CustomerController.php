<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function CustomerIndex(){
        return view('backend.pages.Customer');
    }

    function CustomerData(){
       $customer = json_encode(Order::orderby('id','desc')->get());
       return $customer;
    }

    function CustomerDelete(Request $request){
        $id = $request->input('id');
        $result = Order::where('id','=',$id)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
