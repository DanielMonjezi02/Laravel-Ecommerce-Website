<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SignupPageTest extends TestCase
{

    public function test_sign_up_page_loads()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);

        $response->assertSeeText('Signup');
    }

    public function test_user_can_sign_up_using_the_sign_up_form()
    {
        $user = [
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => '02-04-2001'
        ];        

        $response = $this->post('/register', $user);

        $response->assertValid();

        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
        ]);

        $response->assertRedirect('/home');
    }

    public function test_user_gives_invalid_email_input_when_signing_up()
    {
        $user = [
            'username' => fake()->userName(),
            'email' => 'testmail',
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => '02-04-2001'
        ];     

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInvalid([
            'email' => 'The email must be a valid email address.',
        ]);
    }

    public function test_user_gives_invalid_dob_format_when_signing_up()
    {
        $user = [
            'username' => fake()->userName(),
            'email' => 'testmail@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => 'ad02042001'
        ];     

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInValid([
            'dob' => 'The dob is not a valid date.',
        ]);
    }

    public function test_user_inputs_wrong_password_in_password_confirmation_when_signing_up()
    {
        $user = [
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => '12pass',
            'dob' => '02-04-2001'
        ];     

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInValid([
            'password' => 'The password confirmation does not match.',
        ]);
    }

    public function test_user_can_not_access_sign_up_form_when_logged_in()
    {
        $user = User::factory()->create();

        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        // User logs in
        $this->assertAuthenticated();

        // Tries to go to register page
        $response = $this->get('/register');

        // Gets redirected to home page
        $response->assertRedirect('/home');
    }

    public function test_user_inputs_empty_username_field_when_signing_up()
    {
        $user = [
            'username' => '',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => '02-04-2001'
        ];     

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInValid([
            'username' => 'The username field is required.',
        ]);
    }

    public function test_user_inputs_empty_email_field_when_signing_up()
    {
        $user = [
            'username' => fake()->userName(),
            'email' => '',
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => '02-04-2001'
        ];     

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInValid([
            'email' => 'The email field is required.',
        ]);
    }

    public function test_user_inputs_empty_password_field_when_signing_up()
    {
        $user = [
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '',
            'password_confirmation' => '',
            'dob' => '02-04-2001'
        ];     

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInValid([
            'password' => 'The password field is required.',
        ]);
    }
    
    public function test_user_inputs_empty_dob_field_when_signing_up()
    {
        $user = [
            'username' => '',
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => ''
        ];      

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInValid([
            'dob' => 'The dob field is required.',
        ]);
    }

    public function test_user_gives_all_fields_an_empty_input_when_signing_up()
    {
        $user = [
            'username' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'dob' => '' 
        ];     

        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInvalid([
            'username' => 'The username field is required.',
            'email' => 'The email field is required.',
            'dob' => 'The dob field is required.',
            'password' => 'The password field is required.',
        ]);
    }

    public function test_user_enters_already_used_email_when_signing_up()
    {
        $user = [
            'username' => fake()->userName(),
            'email' => 'admin@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'dob' => '02-04-2001'
        ];  
        
        $response = $this->post('/register', $user);

        $response->assertStatus(302);

        $response->assertInvalid([
            'email' => 'The email has already been taken.'
        ]);
        
    }
}
