<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([ProductSeeder::class]); 
        $this->call([UserSeeder::class]); 
        $this->call([CouponSeeder::class]);
        $this->call([OrderSeeder::class]);
        $this->call([ReviewSeeder::class]);
    }
}
