<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginDisplay(Request $request)
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'],'password' => ['required'],]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('homepage')->with('success','You have signed in successfully');
        }
        return back()->withErrors(['email' => 'Error, login is incorrect. Please try again!.',]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
