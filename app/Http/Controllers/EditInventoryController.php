<?php

namespace App\Http\Controllers;

use App\Faction;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EditInventoryController extends Controller
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

    public function __invoke()
    {

    }

    public function showEditInventory($faction_id = null) {
        return view('edit-inventory', [
            'factions' => !empty($faction_id) ? Faction::find([$faction_id]) : Faction::all()->sortBy('name')
        ]);
    }

}
