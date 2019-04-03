<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'unit_id'
    ];

    public function unit() {
        return $this->belongsTo('App\Unit')->with('rank');
    }

}
