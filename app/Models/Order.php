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

    public function cancel()
    {
        $this->status = 'cancelled';
        $this->save();

        $name = Auth::user()->username;
        $email = Auth::user()->email;
        Mail::to($email)->send(new OrderFailedMail($name));
    }
}
