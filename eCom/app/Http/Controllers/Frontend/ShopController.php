<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use function view;

class ShopController extends Controller
{
   function ShopPage(){

       $products = ProductModel::orderby('id','desc')->get();
       return view('Frontend.Shop.Shop',['products'=>$products])/*->with('products',$products)*/;

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
