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

        return view('Frontend.Pages.Details');
    }

    function ProductDetails($slug,$title){
        $products = ProductModel::where('slug',$slug)->where('title',$title)->get();
        $populars = ProductModel::orderby('id','asc')->limit(4)->get();
        $relatedPro = ProductModel::where('slug',$slug)->limit(8)->get();

        if(!is_null($products)){
            return view('Frontend.Pages.Details',['products'=>$products,'populars'=>$populars,'relatedPro'=>$relatedPro])/*->with('products',$products)*/;
        }else{
            Session()->flash('error','Sorry! there is no Product by this url...');
            return redirect('/ShopPage');

        }
    }
}
