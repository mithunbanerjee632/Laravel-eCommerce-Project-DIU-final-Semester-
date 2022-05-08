<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductModel;

class WishlistController extends Controller
{
  /*  public function __construct(){
        $this->middleware('auth');
    }*/

    function WishlistPage(){
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('Frontend.Pages.Wishlist',compact('wishlist'));
    }

    function WishlistData(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('product_id');

                 $user_id = Auth::id();
                $UserIp =$_SERVER['REMOTE_ADDR'];

                 $result = Wishlist::insert([
                     'user_id'=>$user_id,
                     'product_id'=>$prod_id,
                     'ip_address'=>$UserIp


                 ]);
                 if($result == true){
                     return 1;
                 }else{
                     return 0;
                 }


            }

        }

        function WishlistDelete($id){
            $wishId = Wishlist::find($id);

            if(!is_null($wishId)){
                $wishId->delete();
            }else{
                return redirect('/WishList');
            }
            session()->flash('success','Wishlist Item is Deleted Successfully!!');
            return back();
        }



}
