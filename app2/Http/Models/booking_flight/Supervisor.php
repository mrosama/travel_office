<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model {

    protected $fillable = [ 'name', 'nationality', 'country', 'city', 'code', 'mobile', 'birthDate', 'photo', 'motherName', 'email', 'phone', 'fax', 'skype', 'twitter', 'instgram', 'face',
        'family_card', 'passportNumber', 'passportIssue', 'passportExpire', 'passportPlace', 'passportPhoto',
        'civilRegistry', 'civilRegistryPhoto', 'notes'];

    public function Country() {
        return $this->belongsTo('App\Http\Models\Country', 'country', 'code');
    }

    public function City() {
        return $this->belongsTo('App\Http\Models\City', 'city', 'id');
    }

}
