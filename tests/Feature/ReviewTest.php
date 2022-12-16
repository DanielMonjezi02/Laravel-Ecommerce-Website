<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class ReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_review_page_loads()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $cart = Cart::factory()->create(['product_id' => $product->id, 'user_id' => $user->id]);
        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get(route('reviewProduct', $product));

        $response->assertStatus(200);
    }
}
