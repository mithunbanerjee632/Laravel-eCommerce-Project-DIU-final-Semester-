<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    function TermsConditionPage(){
        return view('Frontend.Pages.TermsCondition');
    }
}
