<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArmyRoster extends Model
{

    protected $guarded = [];

    public function unit()
    {
        return $this->hasOne('App\Unit', 'id', 'unit_id');
    }

    public function army()
    {
        return $this->belongsTo('App\Army', 'army_id', 'id');
    }

}
