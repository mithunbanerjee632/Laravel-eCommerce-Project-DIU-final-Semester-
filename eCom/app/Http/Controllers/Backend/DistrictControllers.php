<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DistrictControllers extends Controller
{
    function DistrictIndex(){
        return view('Backend.pages.District');
    }

    function DistrictData(){

        $district = json_encode(District::orderby('id','desc')->get());
        return $district;
    }

    function DistrictAdd(Request $request){
        $divisionName = $request->input('district_name');
        $divId = $request->input('division_id');

        $result = District::insert([
            'name'=>$divisionName,
            'division_id'=>$divId
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function DistrictDetails(Request $request){
        $id = $request->input('id');
        $result = json_encode(District::where('id','=',$id)->get());
        return $result;

    }

    function DistrictUpdate(Request $request){
        $id = $request->input('dis_id');
        $districtName = $request->input('district_name');
        $divisionId = $request->input('div_id');

        $result = District::where('id','=',$id)->update([
            'name'=>$districtName,
            'div_id'=>$divisionId
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function DistrictDelete(Request $request){
        $id = $request->input('id');
        $result = District::where('id','=',$id)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }


}
