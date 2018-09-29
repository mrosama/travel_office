<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model {

    protected $fillable = ["supplier_id", "name", "age", "nationality", "mobile", "photo", "country", "city", "card_number", "licence", "licence_img", "notes"];

    public function supplier() {
        return $this->belongsTo('App\BussesSupplier', 'supplier_id');
    }

    public function getCountry() {
        return $this->belongsTo('App\Http\Models\Country', 'country', 'code');
    }

    public function getCity() {
        return $this->belongsTo('App\Http\Models\City', 'city');
    }

}
