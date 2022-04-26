<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    function PrivacyPage(){
        return view('Frontend.Pages.PrivacyPolicy');
    }
}
