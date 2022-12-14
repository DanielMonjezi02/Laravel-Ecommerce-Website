<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class AccountController extends Controller
{  
    public function displayAccountSettings()
    {
        $user = auth()->user();
        return view('account', ['user' => $user]);
    }

    public function displayAccountSecurity()
    {
        $user = auth()->user();
        return view('security', ['user' => $user]);
    }

    public function displayAccountOrders()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at')->get();
        return view('orders', ['user' => $user, 'orders' => $orders]);
    }

    public function displayOrderDetails(Order $order)
    {
        $user = auth()->user();
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return view('order-details', ['user' => $user, 'orderItems' => $orderItems, 'order' => $order]);
    }
}
