<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model {

    protected $fillable = ['address', 'date', 'meet_place_id', 'meet_type_id', 'brief', 'employee_id'];

    public function meetingEvent() {
        return $this->hasOne('App\Meeting_event');
    }

    public function getPlace() {
        return $this->belongsTo('App\MeetingPlace'  , 'meet_place_id' , 'id');
    }
    
    public function getType() {
        return $this->belongsTo('App\MeetingType'  , 'meet_type_id' , 'id');
    }

    public function meetingNotifications() {
        return $this->hasMany('App\Notification', 'bill_id');
    }

}
