<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TouristProgram extends Model {

    protected $table = 'tourist_programmes';
    protected $fillable = ["name", "trip_id", "going_date", "flight_days_no", "flight_hours_no", "from_country", "from_city", "from_place", "to_country", "to_city", "to_place", "meals", 'supervisors', 'program_notes', 'launching_notes', 'arriving_notes', 'launch_hour'];

    public function toCity() {
        return $this->belongsTo('App\Http\Models\City', 'to_city');
    }

    public function fromCity() {
        return $this->belongsTo('App\Http\Models\City', 'from_city');
    }

    public function toCountry() {
        return $this->belongsTo('App\Http\Models\Country', 'to_country', 'code');
    }

    public function fromCountry() {
        return $this->belongsTo('App\Http\Models\Country', 'from_country', 'code');
    }

    public function getSupervisors() {
        return $this->belongsTo('App\Http\Models\Employee', 'supervisors');
    }

    public function getTrip() {
        return $this->belongsTo('App\Trip', 'trip_id');
    }

    public function reservedBus() {
        return $this->hasMany('App\Reserved_bus', 'tourist_program_id');
    }

    public function activities() {
        return $this->hasMany('App\Activity', 'tourist_program_id');
    }

}
