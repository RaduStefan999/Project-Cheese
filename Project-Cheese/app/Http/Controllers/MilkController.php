<?php

namespace App\Http\Controllers;

use App\Jobs\MilkCreator;
use App\Jobs\MilkDownloader;
use App\Jobs\MilkLifter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cheese;
use Artisan;

class MilkController extends Controller
{
    public function milkreceiver(Request $milk)
    {
        $id_curent = $milk -> submilk;
        $cheesedata = Cheese::all();
        foreach ($cheesedata as $slices) {
            if ($slices -> id == $id_curent) {
                $slices ->  is_chosen = 1;
                $slices->save();
            }
        }
        return redirect('/controlpanel');
    }
    
    public function milkremover(Request $milk)
    {
        $id_curent = $milk -> submilk;
        $cheesedata = Cheese::all();
        foreach ($cheesedata as $slices) {
            if ($slices -> id == $id_curent) {
                $slices ->  is_chosen = 0;
                $slices->save();
            }
        }
        return redirect('/controlpanel');
    }

    public function milkcommander () {
        if(Auth::check()) {
            $this->dispatch(new MilkLifter());
            return redirect('/controlpanel');
        }
        else {
            return redirect('/');
        }
    }

    public function milkcommander1 () {
        if(Auth::check()) {
            $this->dispatch(new MilkDownloader());
            return redirect('/controlpanel');
        }
        else {
            return redirect('/');
        }
    }

    public function milkcommander2 () {
        if(Auth::check()) {
            $this->dispatch(new MilkCreator());
            return redirect('/controlpanel');
        }
        else {
            return redirect('/');
        }
    }

    public function milkcommander3 () {
        if(Auth::check()) {
            Artisan::call('ResetDatabases');
            return redirect('/controlpanel');
        }
        else {
            return redirect('/');
        }
    }

}
