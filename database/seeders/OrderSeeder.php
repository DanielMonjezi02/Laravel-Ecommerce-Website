<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 15; $i++) {
            $order = Order::factory()->create(['status' => 'paid']);

            $orderItems = OrderItem::factory()->count(5)->create();
            foreach($orderItems as $orderItem)
            {
                $order->total_price = $order->total_price + ($orderItem->unit_price*$orderItem->quantity);
                $order->save();
            }
        }

        for ($i = 0; $i < 15; $i++) {
            $order = Order::factory()->create(['status' => 'unpaid']);

            $orderItems = OrderItem::factory()->count(5)->create();
            foreach($orderItems as $orderItem)
            {
                $order->total_price = $order->total_price + ($orderItem->unit_price*$orderItem->quantity);
                $order->save();
            }
        }

        for ($i = 0; $i < 15; $i++) {
            $order = Order::factory()->create(['status' => 'cancelled']);

            $orderItems = OrderItem::factory()->count(5)->create();
            foreach($orderItems as $orderItem)
            {
                $order->total_price = $order->total_price + ($orderItem->unit_price*$orderItem->quantity);
                $order->save();
            }
        }
    }
}
