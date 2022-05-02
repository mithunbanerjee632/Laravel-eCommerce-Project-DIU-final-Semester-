<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function CategoryIndex(){
        return view('Backend.pages.Category');
    }

    function CategoryData(){
       /* $category = json_encode(CategoryModel::orderby('id','desc')->get());*/
        $category = json_encode(CategoryModel::orderby('id','desc')->get());
        return $category;
    }

    function CategoryAdd(Request $request){
        $catName = $request->input('category_name');
        $catDes = $request->input('category_des');

        $result = CategoryModel::insert([
            'category_name'=>$catName,
            'description'=>$catDes
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function CategoryDetails(Request $request){
        $id = $request->input('id');
        $result = json_encode(CategoryModel::where('id','=',$id)->get());
        return $result;

    }

    function CategoryUpdate(Request $request){
        $id = $request->input('cat_id');
        $catName = $request->input('cat_name');
        $catDes = $request->input('cat_des');

        $result = CategoryModel::where('id','=',$id)->update([
            'category_name'=>$catName,
            'description'=>$catDes
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function CategoryDelete(Request $request){
        $id = $request->input('id');
        $result = CategoryModel::where('id','=',$id)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }


}
