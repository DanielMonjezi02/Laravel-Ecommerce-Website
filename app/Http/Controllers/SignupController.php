<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignupController extends Controller
{
    public function signupDisplay()
    {

        return view('auth/signup');

    }

    public function create(Request $request)
    {

        $request->validate([ // Checks to see if all the data the user inputted is a string as well as the password having at least 5 characters 
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|min:5',
        ]);

        return $this->store($request);

    }

    public function store(Request $request)
    {
        $user = new User([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // calling Hash method from facade that we imported at the top 
        ]);

        $user->save();

        return redirect()->route('create')->with('success','You have signed up successfully');
    }
}
