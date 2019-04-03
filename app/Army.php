<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Army extends Model
{

    protected $table = 'armies';
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'faction_id',
        'name'
    ];

    public function faction() {
        return $this->belongsTo('App\Faction');
    }

    public function army_roster() {
        return $this->hasMany('App\ArmyRoster');
    }

}
