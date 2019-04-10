<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitUpgradeSlot extends Model
{

    public $timestamps = false;

    protected $guarded = [];

    public static function prime_database($json) {

        foreach ($json as $index => $data) {
            foreach ($data['upgrade_slots'] as $slot_index => $upgrade) {
                $instance = UnitUpgradeSlot::firstOrNew(['id' => (($index + 1) * 1000) + $slot_index]);
                $instance->unit_id = $data['unit_id'];
                $instance->upgrade_type_id = $upgrade;
                $instance->save();
            }
        }

    }

}
