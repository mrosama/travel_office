<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructions extends Model
{
    protected $fillable = ['title' , 'type' , 'country' , 'city' , 'file' , 'notes'];

    public function getCountry()
	{
		return $this->hasOne('App\Http\Models\Country' ,  'code' , 'country');
	}

	public function getCity()
	{
		return $this->hasOne('App\Http\Models\City' , 'id' , 'city');
	}
}
