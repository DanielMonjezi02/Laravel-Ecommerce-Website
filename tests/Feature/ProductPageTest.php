<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class ProductPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_page_loads()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);

        $response->assertSeeText('Reviews');
    }

    public function test_all_products_are_displayed_on_page()
    {
        $products = Product::all();

        $response = $this->get('/products');

        foreach($products as $product)
        {
            $response->assertSee($product->name);
        }
    }

    public function test_user_can_add_product_to_cart()
    {
        $user = User::factory()->create();
        $product = Product::first();

        $this->actingAs($user);

        $response = $this->post(route('addProductToCart', $product), ['quantity' => 4]);

        $response->assertStatus(302);

        $response->assertRedirect('/products');

        $this->followRedirects($response)->assertSee('Added product to cart');
        
    }
}
