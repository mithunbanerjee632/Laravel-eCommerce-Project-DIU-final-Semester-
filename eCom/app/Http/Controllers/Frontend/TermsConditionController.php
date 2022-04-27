<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class TermsConditionController extends Controller
{
    function TermsConditionPage(){
        return view('Frontend.Pages.TermsCondition');
    }
}
