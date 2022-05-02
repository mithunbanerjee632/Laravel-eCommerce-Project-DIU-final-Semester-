<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    function ProductIndex(){
        return view('Backend.pages.Products');
    }

    function  ProductsData(){
        $products = json_encode(ProductModel::orderby('id','desc')->get());
        return $products;
    }

    function ProductAdd(Request $request){
        $productName = $request->input('Product_name');
        $productDes = $request->input('Product_des');
        $productCat = $request->input('Product_cat');
        $productBrand = $request->input('Product_brand');
        $productAdmin = $request->input('Product_admin');
        $productSlug = $request->input('Product_slug');
        $productQty = $request->input('Product_Qty');
        $productPrice = $request->input('Product_price');
        $productOffer = $request->input('Product_Offer');
        $productStatus = $request->input('Product_Status');

        $result = ProductModel::insert([
            'category_id' =>$productCat,
            'brand_id'=>$productBrand,
            'title'=>$productName,
            'description'=>$productDes,
            'slug'=>$productSlug,
            'quantity'=>$productQty,
            'price'=>$productPrice,
            'status'=>$productStatus,
            'offer_price'=>$productOffer,
            'admin_id'=>$productAdmin

        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    function ProductDetails(Request $request){
        $id = $request->input('id');
        $result = json_encode(ProductModel::where('id','=',$id)->get());
        return $result;

    }

    function UpdateProduct(Request $request){
        $id = $request->input('id');
        $catId = $request->input('cat_id');
        $brandId = $request->input('brand_id');
        $title = $request->input('title');
        $description = $request->input('description');
        $slug = $request->input('slug');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $status = $request->input('status');
        $offerPrice = $request->input('offer_price');
        $adminId = $request->input('admin_id');

        $result = ProductModel::where('id','=',$id)->update([
            'category_id'=> $catId,
            'brand_id'=> $brandId,
            'title'=>$title,
            'description'=> $description,
            'slug'=> $slug,
            'quantity'=> $quantity,
            'price'=>$price,
            'status'=> $status,
            'offer_price'=> $offerPrice,
            'admin_id'=> $adminId

        ]);

        if($result == true){
           return 1;
        }else{
            return 0;
        }
    }


    function DeleteProduct(Request $request){
        $id = $request->input('id');

        $result = ProductModel::where('id','=',$id)->delete();

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }


}
