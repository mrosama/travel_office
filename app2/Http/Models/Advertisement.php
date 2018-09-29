<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model {

    protected $fillable = ['country', 'city', 'file', 'designer_id', "title", "mobile", "phone", "email", "start", "end", "duration", "notes"];

    public function getCountry() {
        return $this->hasOne('App\Http\Models\Country', 'code', 'country');
    }

    public function getCity() {
        return $this->hasOne('App\Http\Models\City', 'id', 'city');
    }
    
    public function getDesigner() {
        return $this->belongsTo('App\DesignerAdvertising', 'designer_id', 'id');
    }

    public function messageNotifications() {
        return $this->hasMany('App\Message', 'message_id');
    }

}
