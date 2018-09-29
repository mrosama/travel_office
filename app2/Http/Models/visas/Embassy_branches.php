<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embassy_branches extends Model
{
	protected $fillable = ['embassy_id' , 'name' , 'country' , 'city' , 'street' , 'site_url' , 'email' , 'mobile' , 'phone'];

	public function embassy()
	{
		return $this->belongsTo('App\Embassy');
	}
	
	public function getCountry()
	{
		return $this->hasOne('App\Http\Models\Country' ,  'code' , 'country');
	}

	public function getCity()
	{
		return $this->hasOne('App\Http\Models\City' , 'id' , 'city');
	}
}
