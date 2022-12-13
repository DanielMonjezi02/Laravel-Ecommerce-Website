<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Coupon;
use App\Mail\BirthdayMail;

class BirthdayEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to send a birthday email to a user that has their birthday today';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today=now();

        $users = User::whereMonth('dob', $today->month)->WhereDay('dob', $today->day)->get(); // Gets all the users that have their birthday today 

        foreach($users as $user)
        {
            $coupon = new Coupon();
            $coupon->code = strtoupper(fake()->bothify('???###')); // Generates an all upper case code with 3 letters and 3 numbers
            $coupon->type = 'fixed';
            $coupon->value = 3;
            $coupon->save();

            $this->sendMailToUser($user, $coupon);

        }
    }

    public function sendMailToUser(User $user, Coupon $coupon)
    {
        $username = $user->username;
        $email = $user->email;
        Mail::to($email)->send(new BirthdayMail($username, $coupon->code));
    } 
}
