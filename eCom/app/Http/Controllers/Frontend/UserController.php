<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    function UserDashboard(){
        $user = Auth::user();
        return view('Frontend.pages.users.Dashboard',compact('user'));
    }

    function UserProfile(){
        $divisions =Division::orderby('priority','asc')->get();
        $districts = District::orderby('division_id','asc')->get();
        $user = Auth::user();
        return view('Frontend.pages.users.profile',compact('user','divisions','districts'));
    }

    function UserProfileUpdate(Request $request){
        $user = Auth::user();

        $this->validate($request, [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:15',
            'username' => 'required|alpha_dash|max:100|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:100|unique:users,email,'.$user->id,
            'phone_no' => 'required|max:15|unique:users,phone_no,'.$user->id,
/*          'street_address' => 'required|max:100',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'zipcode' => 'required|numeric',
            'country' => 'required|string|max:30',*/



        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->ip_address = request()->ip();
/*        $user->street_address = $request->input('street_address');
        $user->division_id = $request->input('division_id');
        $user->district_id = $request->input('district_id');
        $user->zipcode = $request->input('zipcode');
        $user->country = $request->input('country');
        $user->avatar = $request->input('avatar');*/


        $user->save();


        session()->flash('success', 'User profile has updated successfuly !!');
        return back();
    }
}
