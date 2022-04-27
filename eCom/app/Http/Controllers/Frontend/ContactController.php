<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class ContactController extends Controller
{
    function ContactPage(){
        return view('Frontend.Pages.Contact');
    }
}
