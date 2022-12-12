<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if(!$coupon)
        {
            return redirect()->route('cart.index')->with('alert', 'Invalid coupon code. Please try again.');
        } else
        {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
            if($coupon->type == 'fixed')
            {
                $stripe->coupons->create([
                    'id' => $coupon->code,
                    'currency' => "gbp",
                    'amount_off' => $coupon->value * 100,
                    'duration' => 'once',
                  ]); 
            } else{
                $stripe->coupons->create([
                    'id' => $coupon->code,
                    'percent_off' => $coupon->percent_off,
                    'duration' => 'once',
                  ]); 
            }
            
            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $coupon->discount(CartController::getTotalCartPrice()),
            ]);
    
            return redirect()->route('cart.index')->with('alert', 'Coupon has been applied to the cart!');
        }
    }
        

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $stripe->coupons->delete(session()->get('coupon')['name']);

        session()->forget('coupon');

        return redirect()->route('cart.index')->with('alert', 'Coupon has been removed from cart');
    }
}
