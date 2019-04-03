<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArmyRank extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = [
    ];

    public static function prime_database($ranks_json)
    {

        foreach ($ranks_json as $id => $rank_data) {
            $rank = ArmyRank::firstOrNew(['id' => $id]);
            $rank->fill($rank_data);
            $rank->save();
        }

    }
}
