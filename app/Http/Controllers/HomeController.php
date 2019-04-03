<?php

namespace App\Http\Controllers;

use App\Army;
use App\Faction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home', [
            'factions' => Cache::get('factions'),
            'armies' => $request->user()->armies()->with('faction')->get()
        ]);
    }
}
