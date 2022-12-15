<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->count(2)->create(['status' => 'paid']);
        Order::factory()->count(2)->create(['status' => 'unpaid']);
        Order::factory()->count(2)->create(['status' => 'cancelled']);
    }
}
