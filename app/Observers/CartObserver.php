<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Http\Controllers\CartController;

class CartObserver
{
    /**
     * Handle the Cart "created" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function created(Cart $cart)
    {
        $couponName = session()->get('coupon')['name'];

        if($couponName != NULL)
        {
            $coupon = Coupon::where('code', $couponName)->first();

            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $coupon->discount(CartController::getTotalCartPrice()),
            ]);
        }
    }

    /**
     * Handle the Cart "updated" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function updated(Cart $cart)
    {
        $couponName = session()->get('coupon')['name'];

        if($couponName != NULL)
        {
            $coupon = Coupon::where('code', $couponName)->first();

            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $coupon->discount(CartController::getTotalCartPrice()),
            ]);
        }
    }

    /**
     * Handle the Cart "deleted" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function deleted(Cart $cart)
    {
        $couponName = session()->get('coupon')['name'];

        if($couponName != NULL)
        {
            $coupon = Coupon::where('code', $couponName)->first();

            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $coupon->discount(CartController::getTotalCartPrice()),
            ]);
        }
    }

    /**
     * Handle the Cart "restored" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function restored(Cart $cart)
    {
        //
    }

    /**
     * Handle the Cart "force deleted" event.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function forceDeleted(Cart $cart)
    {
        //
    }
}
