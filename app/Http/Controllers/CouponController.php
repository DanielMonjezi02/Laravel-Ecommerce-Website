<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coupon;
use App\Models\Cart;

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
            $user_id = Auth::id();
            $cartExist = Cart::where('user_id', $user_id)->get();
            if(count($cartExist) > 0)
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
            }
            else{
                return redirect()->route('cart.index')->with('alert', 'Your cart can not be empty when applying a coupon!');
            }
    
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
