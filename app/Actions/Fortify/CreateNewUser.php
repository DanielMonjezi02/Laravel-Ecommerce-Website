<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'dob' => ['required', 'date', 'max:255'],
            'password' => $this->passwordRules(),
        ])->validate();

        $dob = date("Y-d-m", strtotime($input['dob'])); // Changes format to the correct input to store to database 

        return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'dob' => $dob,
            'password' => Hash::make($input['password']),   
        ]);
    }
}
