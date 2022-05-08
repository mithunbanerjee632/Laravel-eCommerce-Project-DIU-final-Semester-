<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use function view;


class ContactController extends Controller
{
    function ContactPage(){
        return view('Frontend.Pages.Contact');
    }

    function ContactSend(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $message = $request->input('message');

        $result = Contact::insert([
            'name'=>$name,
            'email'=>$email,
            'phone_no'=>$phone,
            'message'=>$message
        ]);

        if($result == true){
            return 1;
        }else{
            return 0;
        }
    }
}
