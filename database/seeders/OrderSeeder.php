<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
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

        $orderStatuses = array('paid', 'cancelled', 'unpaid');

        // For user admin@email.com
        foreach($orderStatuses as $orderStatus)
        {
            $order = Order::factory()->create(['status' => $orderStatus, 'user_id' => 1]);
            $orderItems = OrderItem::factory()->count(4)->for($order)->create();

            $orderTotalPrice = 0;
            foreach ($orderItems as $orderItem)
            {
                $orderItemExists = OrderItem::where('order_id', $order->id)->where('product_id', $orderItem->product_id)->get(); // Checks if there are duplicates of orderItem to ensure that there aren't 2 orderItem rows where the product ID and order ID is the same
                if(count($orderItemExists) == 1)
                {
                    $orderTotalPrice = $orderTotalPrice + ($orderItem->quantity*$orderItem->unit_price);
                }
                else{ // If it generated an orderItem with a product that already exists on that order then we delete it
                    OrderItem::where('id', $orderItem->id)->delete();
                }
            }
            $order->total_price = $orderTotalPrice;
            $order->save();
        }

        // For any other user 
        for($i = 0; $i < 5; $i++)
        {
            foreach($orderStatuses as $orderStatus)
            {
                $order = Order::factory()->create(['status' => $orderStatus]);
                $orderItems = OrderItem::factory()->count(4)->for($order)->create();
    
                $orderTotalPrice = 0;
                foreach ($orderItems as $orderItem)
                {
                    $orderItemExists = OrderItem::where('order_id', $order->id)->where('product_id', $orderItem->product_id)->get(); // Checks if there are duplicates of orderItem to ensure that there aren't 2 orderItem rows where the product ID and order ID is the same
                    if(count($orderItemExists) == 1)
                    {
                        $orderTotalPrice = $orderTotalPrice + ($orderItem->quantity*$orderItem->unit_price);
                    }
                    else{ // If it generated an orderItem with a product that already exists on that order then we delete it
                        OrderItem::where('id', $orderItem->id)->delete();
                    }
                }
                $order->total_price = $orderTotalPrice;
                $order->save();
            }
        }
    }

}
