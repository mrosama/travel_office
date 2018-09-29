<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class partner_employees extends Model {

    protected $fillable = ["partner_id", "name", "nationality", "gender", "mobile", "phone", "email", "responsible_for", "skype", "fax", "other", "notes"];

    public function partner() {
        return $this->belongsTo('App\Partner');
    }

    public function user() {
        return $this->hasOne('App\User', 'user_id', 'id')->where('type', "p_emp");
    }

    public function getCountry() {
        return $this->hasOne('App\Http\Models\Country', 'code', 'nationality');
    }

    public function nature_work() {
        return $this->hasOne('App\Nature_work', 'id' ,'responsible_for');
    }

}
