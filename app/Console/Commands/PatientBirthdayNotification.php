<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PatientBirthdayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paientbirthday:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database/Email Notification when it is a patient birthday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        // \Illuminate\Support\Facades\DB::table('users')->insert(
        //     [
        //         'firstname' => 'cron',
        //         'lastname' => 'job',
        //         'country' => 'cronjob',
        //         'email' =>  str_random(40).'@command.com',
        //         'lastname' => 'from cronjob',
        //         'currency' => 'CMD',
        //         'phonenumber' => '08027332873',
        //         'password' => 'sssss',
        //         'role' => 'commamd'
        //     ]
        // );
    }
}
