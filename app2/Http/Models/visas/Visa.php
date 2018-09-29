<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model {

    protected $fillable = ['from_country', 'to_country', 'booking_flight', 'hotel_booking', 'action_definition', 'health_insurance', 'total_photos', 'account_statement', 'fill_out_form', 'passport_photocopy', 'payment_of_fees', 'visa_in_airport', 'passport_with_picture' , 'family_card_with_picture' , 'residence_with_picture' , 'bank_account'  ,  'visa_duration', 'notes', 'embassy_id', 'fill_form_online', 'fill_form_external'];

    public function toCountry() {
        return $this->hasOne('App\Http\Models\Country', 'code', 'to_country');
    }

    public function fromCountry() {
        return $this->hasOne('App\Http\Models\Country', 'code', 'from_country');
    }

    public function embassy() {
        return $this->belongsTo('App\Embassy');
    }

    public function requirements() {
        return $this->hasMany('App\Visa_Requirement');
    }

    public function officialFiles() {
        return $this->hasMany('App\Visa_Official_File');
    }

    public function modefiedFiles() {
        return $this->hasMany('App\Visa_Modified_File');
    }

}
