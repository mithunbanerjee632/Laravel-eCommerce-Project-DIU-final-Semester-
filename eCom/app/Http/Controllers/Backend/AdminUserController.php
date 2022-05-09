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
}
