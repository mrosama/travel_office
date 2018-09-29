<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportType extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'city_from', 'city_to', 'transport_type', 'duration', 'space', 'notes'];

    public function getCountry() {
        return $this->hasOne('App\Http\Models\Country', 'code', 'country_id');
    }

    public function getToCity() {
        return $this->hasOne('App\Http\Models\City', 'id', 'city_to');
    }

    public function getFromCity() {
        return $this->hasOne('App\Http\Models\City', 'id', 'city_from');
    }

    public function getTransportation() {
        return $this->hasOne('App\Transportation', 'id', 'transport_type');
    }

}
