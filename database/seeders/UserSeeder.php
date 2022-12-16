<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $todayDate = Carbon::now();
        User::factory()->count(1)->create(['email' => 'admin@email.com', 'dob' => '1990-' . $todayDate->month . '-' . $todayDate->day]);
        User::factory()->count(9)->create(); // Creating a single user in the database to test with
    }
}
