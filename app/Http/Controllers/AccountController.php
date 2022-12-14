<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{  
    public function displayAccountSettings()
    {
        $user = auth()->user();
        return view('account', ['user' => $user]);
    }
}
