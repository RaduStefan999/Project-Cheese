<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Cheese;

class CheeseController extends Controller
{
    public function docs()
    {
        
    }
    public function controlpanel()
    {
        $cheesedata = Cheese::all();
        if(Auth::check()) {
            return view('controlpanel',compact('cheesedata'));
        }
        return redirect('/');
    }
    public function console() {
        if(Auth::check()) {
            return view('console');
        }
        return redirect('/');
    }
}
