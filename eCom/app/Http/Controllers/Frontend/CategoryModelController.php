<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use function redirect;
use function session;
use function view;

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
