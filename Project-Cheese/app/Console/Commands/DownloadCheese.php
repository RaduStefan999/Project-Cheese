<?php

// Dear maintainer:
 
// When I wrote this code, only I and God
// knew what it was.
// Now, only God knows!
 
// So if you are done trying to 'optimize'
// this routine (and failed),
// please increment the following counter
// as a warning to the next guy:
 
// total_hours_wasted_here = .5


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MeltedCheese;

class DownloadCheese extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheeseDownload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads torrents presented by link in the database to the Downloads Folder';

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
        $MeltedCheese = MeltedCheese::all();
        $extension = "torrent";
        $this->info("Starting to download cheese");
        foreach($MeltedCheese as $cups) {
            if (!$cups->is_done) {
                $pos = (strpos($cups->torrent_link, 'nyaa.si/view/' , 0));
                if (!$pos) {
                    $this->info("Downloaded Error ".$cups->name);
                }
                else {
                    $cups->is_done = 1;
                    $file = file_get_contents($cups->torrent_link);
                    $save = file_put_contents('public/TorrentDownloads/'.$cups->name.'.'.$extension, $file);
                    $cups->save();
                    $this->info("Downloaded ".$cups->name);
                }
            }
        }
    }
}
