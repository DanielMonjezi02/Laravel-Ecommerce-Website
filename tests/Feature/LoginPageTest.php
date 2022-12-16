<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class LoginPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_page_loads()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

        $response->assertSeeText('Login');
    }

    public function test_user_can_login_using_the_login_form()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        // User gets logged in 
        $this->assertAuthenticated();

        $response->assertRedirect('/home');
    }
    
    public function test_user_enters_incorrect_email_then_it_returns_error_when_logging_in()
    {
        $response = $this->post('/login', [
            'email' => 'test@mail.com',
            'password' => 'password'
        ]);

        // Check they get redirected
        $response->assertStatus(302);

        // Check user is not logged in 
        $this->assertFalse(Auth::check());
        
        // Outputs error message
        $response->assertInValid([
            'email' => 'These credentials do not match our records',
        ]);    

        $this->assertGuest(); // Ensures that they aren't authenticated
    }

    public function test_user_enters_all_empty_input_then_it_returns_error_when_logging_in()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => ''
        ]);

        // Check they get redirected
        $response->assertStatus(302);

        // Check user is not logged in 
        $this->assertFalse(Auth::check());
        
        // Outputs error message
        $response->assertInValid([
            'email' => 'The email field is required',
            'password' => 'The password field is required',
        ]);  

        $this->assertGuest();
    }

    public function test_user_enters_empty_password_input_then_it_returns_error_when_logging_in()
    {
        $response = $this->post('/login', [
            'email' => 'testmail@email.com',
            'password' => ''
        ]);

        // Check they get redirected
        $response->assertStatus(302);

        // Check user is not logged in 
        $this->assertFalse(Auth::check());
        
        // Outputs error message
        $response->assertInValid([
            'password' => 'The password field is required',
        ]);

        $this->assertGuest();
    }

    public function test_user_enters_empty_email_input_then_it_returns_error_when_logging_in()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'password'
        ]);

        // Check they get redirected
        $response->assertStatus(302);

        // Check user is not logged in 
        $this->assertFalse(Auth::check());
        
        // Outputs error message
        $response->assertInValid([
            'email' => 'The email field is required',
        ]);

        $this->assertGuest();
    }

    public function test_user_can_see_forgot_password_option_in_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

        $response->assertSeeText('Forgot Password?');
    }
}
