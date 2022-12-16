<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;

class SignupController extends Controller
{
    public function signupDisplay()
    {

        return view('auth/signup');

    }

    public function create(Request $request)
    {
        $newUser = new CreateNewUser();

        $user = $newUser->create($request->all());
    }
}
