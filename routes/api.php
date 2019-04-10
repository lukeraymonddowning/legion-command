<?php

use App\ArmyCostRankAllowance;
use App\ArmyRoster;
use App\Faction;
use App\Inventory;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user/inventory', function (Request $request) {
    return $request->user()->inventory()->with('unit')->get()->sortBy('unit.name')->sortBy('unit.rank.order_of_importance')->sortBy('unit.faction')->toJson();
});

Route::middleware('auth:api')->put('/user/inventory/{unit_id}', function (Request $request, $unit_id) {
    $inventory_item = new Inventory(['unit_id' => $unit_id]);
    $request->user()->inventory()->save($inventory_item);
});

Route::middleware('auth:api')->delete('/user/inventory/{unit_id}', function (Request $request, $unit_id) {
    Inventory::where([
        ['user_id', $request->user()->id],
        ['unit_id', $unit_id]
    ])->take(1)->delete();
});

Route::middleware('auth:api')->post('/user/armies/{faction_id}', function (Request $request, $faction_id) {
    $params = ['faction_id' => $faction_id, 'name' => Input::get('name', '')];
    $army = new \App\Army($params);
    $request->user()->armies()->save($army);

    return $army;
});

Route::middleware('auth:api')->get('/user/armies/{army_id}', function (Request $request, $army_id) {
    return $request->user()->armies()->where('id', $army_id)->first()->army_roster()->with('unit')->get()->sortBy('unit.name')->sortBy('unit.rank.order_of_importance')->values()->toJson();
});

Route::middleware('auth:api')->get('/user/armies/{army_id}/simple', function (Request $request, $army_id) {
    return $request->user()->armies()->where('id', $army_id)->first()->army_roster()->with('unit')->get()->sortBy('unit.name')->sortBy('unit.rank.order_of_importance')->values()->map(function ($roster) {
        return $roster->unit->id;
    })->toJson();
});

Route::middleware('auth:api')->get('/user/armies/{army_id}/rank', function (Request $request, $army_id) {
    $army = $request->user()->armies()->where('id', $army_id)->first();
    $roster = $army->army_roster()->with('unit')->get()->values();

    $rankCountGroups = $roster->mapToGroups(function ($roster, $key) {
        return [$roster->unit->rank->id => [$roster->id]];
    })->map(function ($unit_ids) {
        return count($unit_ids);
    });

    $allowances = ArmyCostRankAllowance::where('points', $army->points_limit)->select('army_rank_id', 'allowance', 'minimum')->with('rank')->get()->values()->sortBy('rank.order_of_importance')->mapWithKeys(function($allowance, $key) {
        $rank_id = $allowance->army_rank_id;
        $rank_name = $allowance->rank->name;
        $rank_image = $allowance->rank->rank_image_asset_url;
        unset($allowance->army_rank_id);
        unset($allowance->rank);
        $allowance['name'] = $rank_name;
        $allowance['rank_image_asset_url'] = $rank_image;
        return [$rank_id => $allowance];
    });

    foreach ($rankCountGroups as $rankId => $count) {
        $allowances[$rankId]['count'] = $count;
    }

    return $allowances->toJson();
});

Route::middleware('auth:api')->get('/user/armies/{army_id}/points', function (Request $request, $army_id) {
    return array_sum($request->user()->armies()->where('id', $army_id)->first()->army_roster()->with('unit')->get()->map(function ($roster) {
        return $roster->unit->points_cost;
    })->values()->toArray());
});

Route::middleware('auth:api')->put('/user/armies/{army_id}/{unit_id}', function (Request $request, $army_id, $unit_id) {
    $army_roster_item = new ArmyRoster([
        'unit_id' => $unit_id
    ]);
    return $request->user()->armies()->where('id', $army_id)->first()->army_roster()->save($army_roster_item);
});

Route::middleware('auth:api')->delete('/user/armies/{army_id}/{unit_id}', function (Request $request, $army_id, $unit_id) {
    $request->user()->armies()->where('id', $army_id)->first()->army_roster()->where([
        ['army_id', '=', $army_id],
        ['unit_id', '=', $unit_id]
    ])->first()->delete();
});

Route::middleware('auth:api')->get('/factions/{faction_id}', function (Request $request, $faction_id) {
    return Faction::where('id', $faction_id)->with('units')->get()->sortBy('unit.army_rank_id')->toJson();
});


