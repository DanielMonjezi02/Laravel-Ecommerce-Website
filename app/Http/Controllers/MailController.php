<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class MailController extends Controller
{
    public function sendOrderMail()
    {
        $name = Auth::user()->username;
        $email = Auth::user()->email;
        Mail::to($email)->send(new OrderMail($name));

        return redirect()->back();
    }
}
