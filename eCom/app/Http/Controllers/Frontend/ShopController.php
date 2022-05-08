<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use function view;

class ShopController extends Controller
{
   function ShopPage(){

       $products = ProductModel::orderby('id','desc')->get();
       $banners = Banner::where('id','=','4')->get();
       $BotBanners = Banner::where('id','=','5')->get();
       $populars = ProductModel::orderby('id','asc')->limit(4)->get();
       return view('Frontend.Shop.Shop',['products'=>$products,'banners'=>$banners,'populars'=>$populars,'BotBanners'=>$BotBanners])/*->with('products',$products)*/;

      /* $products = json_decode( $products = ProductModel::orderby('id','desc')->get());
       return view('Shop',['products'=>$products]);*/
   }

   function Search(Request $request){
       $search = $request->search;
       $products = ProductModel::orwhere('title','like','%'.$search.'%')
           ->orWhere('description','like','%'.$search.'%')
           ->orWhere('slug','like','%'.$search.'%')
           ->orWhere('price','like','%'.$search.'%')
           ->orderby('id','desc')
           ->paginate(9);
       return view('Frontend.Pages.Search',compact('search','products'));

   }

   /*function AllCategories(){
       $categories = CategoryModel::orderby('id','asc')->get();
       return view('Shop',['categories'=>$categories]);
   }*/
}
