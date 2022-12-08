<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([CategorySeeder::class]); // Calling category seeder so it creates the category and products 
        $this->call([UserSeeder::class]); // Calling user seeder to create a temporary user that can be used for testing 
        $this->call([CouponSeeder::class]);
    }
}
