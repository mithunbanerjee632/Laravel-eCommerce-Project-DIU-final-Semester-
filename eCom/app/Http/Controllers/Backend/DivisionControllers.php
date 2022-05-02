<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionControllers extends Controller
{

    function DivisionIndex(){
        return view('Backend.pages.Division');
    }

    function DivisionData(){
        /* $category = json_encode(CategoryModel::orderby('id','desc')->get());*/
        $category = json_encode(Division::orderby('id','desc')->get());
        return $category;
    }

    function DivisionAdd(Request $request){
        $divisionName = $request->input('division_name');
        $priority = $request->input('priority');

        $result = Division::insert([
            'name'=>$divisionName,
            'priority'=>$priority
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function DivisionDetails(Request $request){
        $id = $request->input('id');
        $result = json_encode(Division::where('id','=',$id)->get());
        return $result;

    }

    function DivisionUpdate(Request $request){
        $id = $request->input('div_id');
        $divisionName = $request->input('division_name');
        $priority = $request->input('priority');

        $result = Division::where('id','=',$id)->update([
            'name'=>$divisionName,
            'priority'=>$priority
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function DivisionDelete(Request $request){
        $id = $request->input('id');
        $result = Division::where('id','=',$id)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }









}
