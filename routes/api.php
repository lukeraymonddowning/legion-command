<?php

use App\ArmyRoster;
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
    return $request->user()->inventory()->with('unit')->get()->sortBy('unit.name')->sortBy('unit.rank.order_of_importance')->sortBy('unit.faction')->values()->toJson();
});

Route::middleware('auth:api')->put('/user/inventory/{unit_id}', function(Request $request, $unit_id) {
    $inventory_item = new \App\Inventory(['unit_id' => $unit_id]);
    $request->user()->inventory()->save($inventory_item);
});

Route::middleware('auth:api')->delete('/user/inventory/{unit_id}', function(Request $request, $unit_id) {
    \App\Inventory::where([
        ['user_id', $request->user()->id],
        ['unit_id', $unit_id]
    ])->take(1)->delete();
});

Route::middleware('auth:api')->post('/user/armies/{faction_id}', function(Request $request, $faction_id) {
    $params = ['faction_id' => $faction_id, 'name' => Input::get('name', '')];
    $army = new \App\Army($params);
    $request->user()->armies()->save($army);

    return $army;
});

Route::middleware('auth:api')->get('/user/armies/{army_id}', function (Request $request, $army_id) {
    return $request->user()->armies()->where('id', $army_id)->first()->army_roster()->with('unit')->get()->sortBy('unit.name')->sortBy('unit.rank.order_of_importance')->values()->toJson();
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



