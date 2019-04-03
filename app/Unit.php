<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'unit_card_image_asset_url',
        'faction',
        'army_rank_id'
    ];

    public static function prime_database($units_json) {

        foreach ($units_json as $index => $unit_data) {
            $unit = Unit::firstOrNew(['id' => $index + 1]);
            $unit->fill($unit_data);
            $unit->save();
        }

    }

    public function rank() {
        return $this->hasOne('App\ArmyRank', 'id', 'army_rank_id');
    }

}
