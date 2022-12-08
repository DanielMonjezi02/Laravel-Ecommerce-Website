<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => '5OFF',
            'type' => 'fixed',
            'value' => 5,
        ]);

        Coupon::create([
            'code' => '10OFF',
            'type' => 'percent',
            'percent_off' => 20,
        ]);
    }
}
