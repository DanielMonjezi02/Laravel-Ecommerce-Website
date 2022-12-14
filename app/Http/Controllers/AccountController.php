<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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
        $orders = Order::where('user_id', $user->id)->get();
        return view('orders', ['user' => $user, 'orders' => $orders]);
    }
}
