<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BussesHanding extends Model {

    protected $fillable = ['driverID', 'busID', 'benzeneCoupon', 'amountCoupon', 'kiloMeter', 'notes'];

    public function Driver() {
        return $this->belongsTo('App\Driver', 'driverID');
    }

    public function Bus() {
        return $this->belongsTo('App\Bus', 'busID');
    }

}
