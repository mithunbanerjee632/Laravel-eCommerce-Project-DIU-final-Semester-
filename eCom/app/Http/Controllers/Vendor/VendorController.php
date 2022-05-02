<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

class VendorController extends Controller
{
   function VendorLogin(){
       return view('Vendor.VendorLogin');
   }

   function VendorLoginForm(Request $request){
       $request->validate([
           'email'=>'required',
           'password'=>'required',
       ]);

       $email = $request->input('email');
       $pass  = $request->input('password');

       if(Auth::guard('vendor')->attempt(['email'=>$email,'password'=>$pass])){
           return redirect('/vendor/dashboard');

       }else{
           Session::flash('error-msg','Invalid Email And Password');
           return redirect()->back();
       }
   }

   function VendorLogout(){
       Auth::guard('vendor')->logout();
       return redirect('/vendor/login');
   }

}
