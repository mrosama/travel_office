<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusStop extends Model {

    protected $fillable = ["logo", "name", "tel", "mobile", "email", "twitter", "face", "skype", "commercial_record_no", "country", "city", "street", "lat", "long", "notes", "mailbox", "postal_code", "fax", "website", "commercial_reg_img"];

    public function getCountry() {
        return $this->belongsTo('App\Http\Models\Country', 'country', 'code');
    }

    public function getCity() {
        return $this->belongsTo('App\Http\Models\City', 'city', 'id');
    }

}
