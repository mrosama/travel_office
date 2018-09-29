<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BussesBranch extends Model {

    protected $fillable = ['name', 'country', 'city', 'mangerName', 'phone', 'email'];

    public function Country() {
        return $this->belongsTo('App\Http\Models\Country', 'country', 'code');
    }

    public function City() {
        return $this->belongsTo('App\Http\Models\City', 'city', 'id');
    }

}
