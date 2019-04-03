<?php

namespace App\Http\Controllers;

use App\Army;
use App\Faction;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EditArmyController extends Controller
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

    public function saveArmy(Request $request, $faction_id, $army_id) {

        if ($request->filled('delete_army')) {
            $army = $request->user()->armies()->where('id', $army_id)->first();
            $army->delete();

            return Redirect::to(
                route('home')
            );
        }

        if ($request->filled('save_army') || $request->filled('save_army_exit')) {

            $army = $request->user()->armies()->where('id', $army_id)->first();
            $army->name = Input::get('name');
            $army->description = Input::get('description', '');
            $army->points_limit = Input::get('points_limit', 800);
            $army->limit_to_user_inventory = !empty(Input::get('limitUnitsToInventory', false)) ? 1 : 0;
            $army->save();

        }

        // Return them to the same page
        if ($request->filled('save_army')) {
            return Redirect::to(
                route('edit-army', [
                    'faction_id' => $faction_id,
                    'army_id' => $army_id
                ])
            );
        } else if ($request->filled('save_army_exit')) {
            return Redirect::to(
                route('home')
            );
        }

    }

    public function showEditArmy(Request $request, $faction_id, $army_id = null)
    {

        if (empty($army_id)) {
            $params = ['faction_id' => $faction_id, 'name' => Input::get('name', '')];
            $army = new Army($params);
            $request->user()->armies()->save($army);

            return Redirect::to(
                route('edit-army', [
                    'faction_id' => $faction_id,
                    'army_id' => $army->id
                ])
            );
        }

        return view('edit-army', [
            'faction' => Faction::find($faction_id),
            'army' => Army::find($army_id)
        ]);
    }

}
