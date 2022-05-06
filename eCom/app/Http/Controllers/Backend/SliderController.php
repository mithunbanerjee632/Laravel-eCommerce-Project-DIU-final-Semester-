<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    function SliderPage(){
        return view('backend.pages.Slider');
    }

    function SliderData(){
        $slider = json_encode(Slider::orderby('id','asc')->get());
        return $slider;
    }

    function SliderAdd(Request $request){
        $title = $request->input('title');
        $desc = $request->input('des');
        $price = $request->input('price');
        $btnTxt = $request->input('btnText');
        $link = $request->input('link');
        $img = $request->input('img');
        $priority = $request->input('priority');


        $result = Slider::insert([
            'title'=>$title,
            'description'=>$desc,
            'price'=>$price,
            'button_text'=>$btnTxt,
            'button_link'=>$link,
            'image'=>$img,
            'priority'=>$priority
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function SliderDetails(Request $request){
        $id = $request->input('id');
        $result= Slider::where('id','=',$id)->get();

       return $result;
    }

    function SliderUpdate(Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $desc = $request->input('des');
        $price = $request->input('price');
        $btnTxt = $request->input('txt');
        $link = $request->input('link');
        $img = $request->input('img');
        $priority = $request->input('priority');

        $result = Slider::where('id','=',$id)->update([
            'title'=>$title,
            'description'=>$desc,
            'price'=>$price,
            'button_text'=>$btnTxt,
            'button_link'=>$link,
            'image'=>$img,
            'priority'=>$priority
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }

    function SliderDelete(Request $request){
        $id = $request->input('id');

        $result = Slider::where('id','=',$id)->delete();
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
