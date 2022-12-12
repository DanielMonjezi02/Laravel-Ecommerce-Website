<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\OrderConfirmedMail;
use App\Mail\OrderFailedMail;

class Order extends Model
{
    use HasFactory;

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cancelled()
    {
        $this->status = 'cancelled';
        $this->save();

        $name = Auth::user()->username;
        $email = Auth::user()->email;
        Mail::to($email)->send(new OrderFailedMail($name));
    }

    public function success()
    {
        // Clears all the carts that are associated to the user so that the cart is now empty after order 
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->delete();

        $this->status = 'paid';
        $this->save();
        
        // Delete coupon if one has been used
        if(session()->get('coupon'))
        {
            Coupon::where('code', session()->get('coupon')['name'])->delete();
            session()->forget('coupon');
        }
        
    }
}
