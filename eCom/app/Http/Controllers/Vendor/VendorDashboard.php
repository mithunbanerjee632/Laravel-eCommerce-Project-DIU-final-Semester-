<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorDashboard extends Controller
{
    function vendorDashboard(){
        return view('Vendor.pages.VendorDashboard');
    }
}
