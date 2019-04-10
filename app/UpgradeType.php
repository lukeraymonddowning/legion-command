<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpgradeType extends Model
{

    protected $table = 'upgrade_types';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = [];

    public static function prime_database($json) {

        foreach ($json as $index => $data) {
            $instance = UpgradeType::firstOrNew(['id' => $index]);
            $instance->fill($data);
            $instance->save();
        }

    }

}
