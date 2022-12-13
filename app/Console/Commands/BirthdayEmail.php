<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        return Command::SUCCESS;
    }
}
