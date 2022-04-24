<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;


class DetailsController extends Controller
{
    function DetailsPage(){
        return view('Details');
    }

    function ProductDetails($slug){
        $products = ProductModel::where('slug',$slug)->get();

        if(!is_null($products)){
            return view('Details')->with('products',$products);
        }else{
            Session()->flash('error','Sorry! there is no Product by this url...');
            return redirect('/ShopPage');

        }
    }
}
