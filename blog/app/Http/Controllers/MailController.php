<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class MailController extends Controller
{
    function sendEmail(Request $req){
        // $to="ahemadbakali26@gmail.com";
        // $msg="hello";
        // $subject="testing";
        // Mail::to($to)->send(new WelcomeEmail($msg,$subject));

        $to=$req->to;
        $msg=$req->message;
        $subject=$req->subject;
        Mail::to($to)->send(new WelcomeEmail($msg,$subject));

        return "Email Sent";


    }

    
}
