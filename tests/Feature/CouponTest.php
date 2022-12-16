<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\CartController;
use Tests\TestCase;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Cart;

class CouponTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_coupon_added_on_a_empty_cart_gives_error_message()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('coupon.store'), ['coupon_code' => '5OFF']);

        $response->assertStatus(302);

        $response->assertRedirect('/cart');

        $this->followRedirects($response)->assertSee('Your cart can not be empty when applying a coupon!');
    }

    public function test_fixed_coupon_added_to_cart()
    {
        $user = User::factory()->create();
        $coupon = Coupon::factory()->create(['type' => 'fixed', 'value' => 10]);
        $carts = Cart::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->post(route('coupon.store'), ['coupon_code' => $coupon->code]);

        $response->assertStatus(302);

        $response->assertRedirect('/cart');

        $this->followRedirects($response)->assertSee('Coupon has been applied to the cart!');
    }

    
    public function test_percentage_coupon_added_to_cart()
    {
        $user = User::factory()->create();
        $coupon = Coupon::factory()->create(['type' => 'percent', 'percent_off' => 15]);
        $carts = Cart::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        // Adding coupon to cart
        $response = $this->post(route('coupon.store'), ['coupon_code' => $coupon->code]);

        $response->assertStatus(302);

        $response->assertRedirect('/cart');

        // Check we get redirected with a message 
        $this->followRedirects($response)->assertSee('Coupon has been applied to the cart!');
    }

    public function test_fixed_coupon_reduces_cart_total_price()
    {
        $user = User::factory()->create();
        $coupon = Coupon::factory()->create(['type' => 'fixed', 'value' => 10]);
        $carts = Cart::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        // The cart total without any coupons applied 
        $originalCartTotal = CartController::getTotalCartPrice();

        // Adding £5 OFF Coupon to cart
        $response = $this->post(route('coupon.store'), ['coupon_code' => $coupon->code]);

        $response->assertStatus(302);

        $response->assertRedirect('/cart');

        $this->followRedirects($response)->assertSee('Coupon has been applied to the cart!');

        // The updated cart total after coupon has been applied 
        $afterCouponCartTotal = CartController::getTotalCartPrice();

        // Calculate the new total which is the total of the original cart price - coupon value
        $CartTotal = $originalCartTotal - $coupon->value;
        
        $this->assertEquals($CartTotal, $afterCouponCartTotal); 
    }

    public function test_percentage_coupon_reduces_cart_total_price()
    {
        $user = User::factory()->create();
        $coupon = Coupon::factory()->create(['type' => 'percentage', 'percent_off' => 10]);
        $carts = Cart::factory()->count(3)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        // The cart total without any coupons applied 
        $originalCartTotal = CartController::getTotalCartPrice();

        // Adding 10% OFF Coupon to cart
        $response = $this->post(route('coupon.store'), ['coupon_code' => $coupon->code]);

        $response->assertStatus(302);

        $response->assertRedirect('/cart');

        $this->followRedirects($response)->assertSee('Coupon has been applied to the cart!');

        // The updated cart total after coupon has been applied 
        $afterCouponCartTotal = CartController::getTotalCartPrice();

        // Calculate the new total which is the total of the original cart price - coupon value
        $CartTotal = $originalCartTotal - (($coupon->value / 100) * $coupon->percent_off);
        
        $this->assertEquals($CartTotal, $afterCouponCartTotal); 
    }
}
