<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BussesReservation extends Model {

    protected $fillable = ['clientID', 'branch_id', 'supplier_id', 'bus_id', 'startDate', 'dayNumber', 'endDate', 'countryDeparture', 'cityDeparture', 'placeDeparture', 'latitudeDeparture', 'longitudeDeparture', 'countryArrival', 'cityArrival', 'placeArrival', 'latitudeArrival', 'longitudeArrival', 'notes'];

    public function Client() {
        return $this->belongsTo('App\Client', 'clientID', 'id');
    }

    public function Branch() {
        return $this->belongsTo('App\BussesBranch', 'branch_id', 'id');
    }

    public function Supplier() {
        return $this->belongsTo('App\BussesSupplier', 'supplier_id', 'id');
    }

    public function Bus() {
        return $this->belongsTo('App\Bus', 'bus_id', 'id');
    }

    public function CountryDeparture() {
        return $this->belongsTo('App\Http\Models\Country', 'countryDeparture', 'code');
    }

    public function CityDeparture() {
        return $this->belongsTo('App\Http\Models\City', 'cityDeparture', 'id');
    }

    public function CountryArrival() {
        return $this->belongsTo('App\Http\Models\Country', 'countryArrival', 'code');
    }

    public function CityArrival() {
        return $this->belongsTo('App\Http\Models\City', 'cityArrival', 'id');
    }

}
