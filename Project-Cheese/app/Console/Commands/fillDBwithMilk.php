<?php

// Dear maintainer:
 
// When I wrote this code, only I and God
// knew what it was.
// Now, only God knows!
 
// So if you are done trying to 'optimize'
// this routine (and failed),
// please increment the following counter
// as a warning to the next guy:
 
// total_hours_wasted_here = 6

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Cheese;
use App\MeltedCheese;

class fillDBwithMilk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckForCheese';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the curent list of entryes and inserts it into the DB';

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

    public function get_name ($text,$pos) {
        $startpos = (strpos($text, '>' , $pos+11));
        $startpos++;
        $name = "";
        $i = 0;
        while ($text[$startpos]!='<') {
            $name[$i] = $text[$startpos];
            $i++;
            $startpos++;
        }
        return $name;
    }

    public function get_link ($text,$pos) {
        $startpos = (strpos($text, '=' , $pos+11));
        $startpos+=2;
        $link = "";
        $i = 0;
        while ($text[$startpos]!='"') {
            $link[$i] = $text[$startpos];
            $i++;
            $startpos++;
        }
        return $link;
    }

    public function parse_data($text) {
        $position = 0;
        $obj = [];
        do {
            if ($position) {
                $name = self::get_name($text,$position);
                $link = self::get_link($text,$position);
                $obj[] = [
                    'name' => $name,
                    'link' => $link
                ];
                
            }
            $position = (strpos($text, 'ind-show' , $position+1));
        } while ($position);
        return $obj;
    }


    public function get_name_episodes ($text, $pos) {
        $name = "";
        $startpos = (strpos($text, '>' , $pos+16));
        $startpos = (strpos($text, '>' , $startpos+1));
        $startpos++;
        $i = 0;
        while ($text[$startpos]!='<') {
            $name[$i] = $text[$startpos];
            $i++;
            $startpos++;
        }
        $startpos = (strpos($text, '>' , $startpos+1));
        $startpos++;
        while ($text[$startpos]!='<') {
            $name[$i] = $text[$startpos];
            $i++;
            $startpos++;
        }
        
        return $name;
    }

    public function get_link_episodes ($text, $pos) {
        $link = "";
        $startpos = (strpos($text, 'rls-links-container' , $pos+1));
        $startpos = (strpos($text, 'rls-link link-720p' , $startpos+1));
        $startpos = (strpos($text, 'dl-type hs-torrent-link' , $startpos+1));
        $startpos = (strpos($text, 'href' , $startpos+1));
        $startpos+=6;
        $i = 0;
        while ($text[$startpos]!='"') {
            $link[$i] = $text[$startpos];
            $i++;
            $startpos++;
        }
        
        return $link;
    }


    public function parse_episodes_data ($text) {
        $position = 0;
        $obj = [];
        do {
            
            if ($position) {
                $name = self::get_name_episodes($text,$position);
                $link = self::get_link_episodes($text,$position);
                $obj[] = [
                    'name' => $name,
                    'link' => $link
                ];
            }
            
            $position = (strpos($text, 'rls-label' , $position+1));
        

        } while ($position);
        
        return $obj;
    }

    public function handle()
    {
        /*

            string vars


        */


        $path_phantom = 'C:\xampp\htdocs\Project-Cheese\bin\phantomjs.exe';
        $path_script = 'C:\xampp\htdocs\Project-Cheese\bin\scripts\getdata.js';
        $path_link = 'https://horriblesubs.info';


        $this->info("Loocking for milk");
        $data = file_get_contents($path_link.'/current-season/');
        if ($data) {
            $DB_SHOWS = self::parse_data($data);
        }
        for($i = 0; $i < sizeof($DB_SHOWS);$i++)
        {
            $OK = 0;
            //$Cheese->refresh();
            $Cheese = Cheese::all();
            foreach ($Cheese as $slices) {
                if ($slices ->name == $DB_SHOWS[$i]['name']) {
                    $slices ->link = $DB_SHOWS[$i]['link'];
                    $slices->save();
                    $OK = 1;
                }
            }
            if (!$OK) {
                $MoreCheese = new Cheese;
                $MoreCheese->name = $DB_SHOWS[$i]['name'];
                $MoreCheese->link = $DB_SHOWS[$i]['link'];
                $MoreCheese->save();
            }
            
        }
        //foreach entry in the database 
        $Cheese = Cheese::all();
        foreach ($Cheese as $slices) {
            if ($slices ->is_chosen) {
                ob_start();
                $response = passthru( $path_phantom.' '.$path_script.' '.$path_link.$slices ->link);
                $output = ob_get_contents();
                $data = $output;
                if ($data) {
                    $DB_EPISODES = self::parse_episodes_data($data);
                    for($i = 0; $i < sizeof($DB_EPISODES);$i++)
                    {
                        $OK = 0;
                        //$Cheese->refresh();
                        $MeltedCheese = MeltedCheese::all();
                        foreach ($MeltedCheese as $cups) {
                            if ($cups ->name == $DB_EPISODES[$i]['name']) {
                                $cups ->torrent_link = $DB_EPISODES[$i]['link'];
                                $cups->save();
                                $OK = 1;
                            }
                        }
                        if (!$OK) {
                            $MoreMeltedCheese = new MeltedCheese;
                            $MoreMeltedCheese->name = $DB_EPISODES[$i]['name'];
                            $MoreMeltedCheese->torrent_link = $DB_EPISODES[$i]['link'];
                            $MoreMeltedCheese->save();
                        }
                        
                    }
                }

                

            }
        }
        $this->info("Filling the database");
        $this->info("All DONE! Database has all the milk ready, the cheese will be done in one 5 minutes");
    }
}
