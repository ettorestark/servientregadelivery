<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;
use Log;

class EmailController extends Controller
{
    public function sendEmail($email, $trakingurl, $message){
        Mail::to($email)->queue(new MessageReceived($message, $trakingurl));
    }   

    public function testEmail(){
        return view('shopify.mail.track',["", "", ""]);
    }   
}