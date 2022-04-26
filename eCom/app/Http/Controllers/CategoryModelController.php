<?php

namespace App\Http\Controllers;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class CategoryModelController extends Controller
{
/* function Category(){
        $categories = CategoryModel::orderby('id','asc')->get();
        return view('Component.HomeCategories')->with('categories',$categories);
}*/

    function ProductByCategories($id){
        $category = CategoryModel::where('id',$id)->get();

        if(!is_null($category)){
            return view('Frontend.Component.HomeCategories',compact('category'));
        }else{
            Session()->flash('error','Sorry! there is no Category by this url...');
            return redirect('/');

        }
      /* return view('Component.HomeCategories')->with('products',$products);*/

    }
}
