<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\OrderItem;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => fake()->numerify('######'),
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => 'paid',
            'total_price' => OrderItem::where('user_id', 'user_id')->sum('unit_price'),
        ];
    }
}
