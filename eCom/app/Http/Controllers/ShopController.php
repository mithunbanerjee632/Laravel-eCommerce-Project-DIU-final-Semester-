<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;

class ShopController extends Controller
{
   function ShopPage(){

       $products = ProductModel::orderby('id','desc')->get();
       return view('Shop',['products'=>$products])/*->with('products',$products)*/;

      /* $products = json_decode( $products = ProductModel::orderby('id','desc')->get());
       return view('Shop',['products'=>$products]);*/
   }
}
