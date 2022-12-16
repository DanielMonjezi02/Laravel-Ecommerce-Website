<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\CartController;
use Tests\TestCase;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;

class CartPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cart_page_loads()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/cart');

        $response->assertStatus(200);
    }

    public function test_user_not_logged_in_cant_access_cart_page()
    {
        $response = $this->get('/cart');

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }

    public function test_all_carts_of_the_user_is_displayed()
    {
        $user = User::factory()->create();
        $carts = Cart::factory()->count(4)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get('/cart');

        foreach($carts as $cart)
        {
            $response->assertSee($cart->product->name); // See the product name
        }
    }

    public function test_cart_total_price_displays_correctly()
    {
        $user = User::factory()->create();
        $carts = Cart::factory()->count(4)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $totalPriceCarts = 0;
        foreach($carts as $cart)
        {
            $totalPriceCarts = ($totalPriceCarts + ($cart->product->price*$cart->quantity));
        }

        $cartPrice = CartController::getTotalCartPrice();

        $this->assertEquals($totalPriceCarts, CartController::getTotalCartPrice());
    }

    public function test_if_cart_empty_checkout_button_does_not_display()
    {
        $user = User::factory()->create();
        Cart::where('user_id')->delete();
        
        $this->actingAs($user);

        $response = $this->get('/cart');

        $response->assertStatus(200);

        $response->assertSee('Your cart is currently empty');
    }

    public function test_if_user_has_carts_checkout_button_is_displayed()
    {
        $user = User::factory()->create();
        $carts = Cart::factory()->count(4)->create(['user_id' => $user->id]);
        
        $this->actingAs($user);

        $response = $this->get('/cart');

        $response->assertStatus(200);

        $response->assertSee('Checkout');
    }

    public function test_cart_total_price_updates_upon_removing_a_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $cart = Cart::factory()->create(['product_id' => $product->id, 'user_id' => $user->id]);

        $this->actingAs($user);

        // Check the price within of the product*quantity in cart table should be displayed at the cart total price 
        $this->assertEquals(($product->price*$cart->quantity), CartController::getTotalCartPrice());

        // Delete cart
        $this->delete(route('cart.destroy', $cart));

        // Cart empty, total should be 0
        $this->assertEquals(0, CartController::getTotalCartPrice());
    }
  
}
