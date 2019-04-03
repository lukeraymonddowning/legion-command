<?php

namespace App;

use App\Scopes\UnitsExistScope;
use Illuminate\Database\Eloquent\Model;

class Faction extends Model
{
    //

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function units() {
        return $this->hasMany('App\Unit', 'faction')->with('rank');
    }

    public function unitsOrdered() {
        return $this->units()->get()->sortBy('name')->sortBy('rank.order_of_importance');
    }

    public static function prime_database() {

        $factions = [
            [
                'id' => 'rebels',
                'name' => 'Rebel Alliance',
                'force_side' => 'light'
            ],
            [
                'id' => 'imperials',
                'name' => 'Galactic Empire',
                'force_side' => 'dark'
            ],
            [
                'id' => 'republic',
                'name' => 'Galactic Republic',
                'force_side' => 'light'
            ],
            [
                'id' => 'separatist',
                'name' => 'Separatist Alliance',
                'force_side' => 'dark'
            ]
        ];

        foreach ($factions as $faction_data) {
            $faction = Faction::firstOrNew($faction_data['id']);
            $faction->fill($faction_data);
            $faction->save();
        }

    }


}
