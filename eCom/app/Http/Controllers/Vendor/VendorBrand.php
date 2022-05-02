<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandModel;

class VendorBrand extends Controller
{
    function VendorBrand(){
        return view('Vendor.pages.VendorBrands');
      }

      function getBrandsData(){
        $brands = json_encode(BrandModel::orderby('id','desc')->get());

        return $brands;
    }

    function BrandAdd(Request $request){
       $brandName =  $request->input('brand_name');
       $brandDes =  $request->input('brand_des');

       $result = BrandModel::insert([
           'brand_name'=>$brandName,
           'description'=>$brandDes
       ]);

       if($result == true){
           return 1;
       }else{
           return 0;
       }
    }

    function BrandDetails(Request $request){
        $brandId = $request->input('id');

        $result = BrandModel::where('id','=',$brandId)->get();
        return $result;
    }

    function BrandUpdate(Request $request){
       $brandId =  $request->input('brand_id');
       $brandName =  $request->input('brand_name');
       $brandDes =  $request->input('brand_des');

       $result = BrandModel::where('id','=',$brandId)->update([
           'brand_name'=>$brandName,
           'description'=>$brandDes
       ]);

       if($result == true){
           return 1;
       }else{
           return 0;
       }
    }

    function BrandDelete(Request $request){
        $brandId = $request->input('id');

        $result = BrandModel::where('id','=',$brandId)->delete();

        if($result == true){
           return 1;
        }else{
            return 0;
        }
    }
}
