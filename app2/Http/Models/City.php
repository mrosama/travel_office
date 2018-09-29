<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'country_code', 'code', 'lineOpen'];

    public function country() {
        return $this->belongsTo('App\Http\Models\Country', 'country_code', 'countryDeparture');
    }

    public function getCountry() {
        return $this->belongsTo('App\Http\Models\Country', 'country_code', 'code');
    }

}
