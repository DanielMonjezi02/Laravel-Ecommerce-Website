<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        if($this->type == 'fixed')
        {
            return $this->value;
        } elseif ($this->type == 'percent')
        {
            return round(($this->percent_off / 100) * $total, 2);
        } else 
        {
            return 0;
        }
    }
}
