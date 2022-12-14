<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function recoveryLogin()
    {
        return view('auth.two-factor-recovery-code-authentication');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
}
