<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embassy extends Model
{
	protected $fillable = ['name' , 'presence' , 'country' , 'city' , 'street' , 'site_url' , 'email' , 'mobile' , 'phone' , 'office'];

	public function getCountry()
	{
		return $this->hasOne('App\Http\Models\Country' ,  'code' , 'country');
	}

	public function getCity()
	{
		return $this->hasOne('App\Http\Models\City' , 'id' , 'city');
	}

	public function branches()
	{
		return $this->hasMany('App\Embassy_branches');
	}
	
}
