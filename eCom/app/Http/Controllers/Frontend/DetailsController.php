<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use function redirect;
use function session;
use function view;


class DetailsController extends Controller
{
    function DetailsPage(){
        return view('Details');
    }

    function ProductDetails($slug){
        $products = ProductModel::where('slug',$slug)->get();

        if(!is_null($products)){
            return view('Frontend.Pages.Details')->with('products',$products);
        }else{
            Session()->flash('error','Sorry! there is no Product by this url...');
            return redirect('/ShopPage');

        }
    }
}
