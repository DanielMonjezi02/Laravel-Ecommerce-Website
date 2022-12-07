<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmedMail;
use App\Mail\OrderFailedMail;

class MailController extends Controller
{
    public function sendOrderConfirmationMail()
    {
        $name = Auth::user()->username;
        $email = Auth::user()->email;
        Mail::to($email)->send(new OrderConfirmationMail($name));

        return redirect()->back();
    }

    public function sendOrderFailedMail()
    {
        $name = Auth::user()->username;
        $email = Auth::user()->email;
        Mail::to($email)->send(new OrderFailedMail($name));

        return redirect()->back();
    }
}
