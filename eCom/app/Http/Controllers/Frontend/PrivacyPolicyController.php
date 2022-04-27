<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class PrivacyPolicyController extends Controller
{
    function PrivacyPage(){
        return view('Frontend.Pages.PrivacyPolicy');
    }
}
