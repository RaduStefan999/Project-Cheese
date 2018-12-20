<?php

// Dear maintainer:
 
// When I wrote this code, only I and God
// knew what it was.
// Now, only God knows!
 
// So if you are done trying to 'optimize'
// this routine (and failed),
// please increment the following counter
// as a warning to the next guy:
 
// total_hours_wasted_here = .2

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class CheeseOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Cheese';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ShortCut for CheckForCheese and Download Cheese';

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
        $this->info("Executing cheese order 66");
        $command1 = 'CheckForCheese';
        $command2 = 'CheeseDownload';
        $this->info("This may take a while");
        $exitCode = Artisan::call($command1);
        $exitCode = Artisan::call($command2);
        $this->info("ALL IS DONE!!!");
    }
}
