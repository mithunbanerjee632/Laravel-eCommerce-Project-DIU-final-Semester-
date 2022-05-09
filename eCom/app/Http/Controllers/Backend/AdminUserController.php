<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AdminUserController extends Controller
{
    function UserIndex(){
        return view('backend.pages.Users');
    }

    function UserData(){
        $user = json_encode(User::orderby('id','desc')->get());
        return $user;
    }

    function UserDetails(Request $request){
        $id = $request->input('id');

        $userData = User::where('id','=',$id)->get();
        return $userData;

    }

    function UserDelete(Request $request){
        $id = $request->input('id');
        $result = User::where('id','=',$id)->delete();
        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
