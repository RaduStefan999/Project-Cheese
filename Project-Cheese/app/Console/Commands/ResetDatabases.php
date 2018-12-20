<?php

// Dear maintainer:
 
// When I wrote this code, only I and God
// knew what it was.
// Now, only God knows!
 
// So if you are done trying to 'optimize'
// this routine (and failed),
// please increment the following counter
// as a warning to the next guy:
 
// total_hours_wasted_here = .1

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Cheese;
use App\MeltedCheese;
use App\Job;

class ResetDatabases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResetDatabases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets all database except for the ones linked to the acount';

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
        $aux = Cheese::all();
        if ($aux->count()) {
            Cheese::truncate();
        }
        $aux = MeltedCheese::all();
        if ($aux->count()) {
            MeltedCheese::truncate();
        }
        $aux = Job::all();
        if ($aux->count()) {
            Job::truncate();
        }
        $this->info("All databases have been reseted");
    }
}
