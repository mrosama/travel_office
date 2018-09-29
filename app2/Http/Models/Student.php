<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $fillable = ['institute_id' , 'name' , 'country' , 'city' , 'birth_date' , 'nationality' , 'email' , 'mobile' , 'notes' , 'photo'];

	public function getCountry()
	{
		return $this->hasOne('App\Http\Models\Country' ,  'code' , 'country');
	}

	public function getCity()
	{
		return $this->hasOne('App\Http\Models\City' , 'id' , 'city');
	}
}
