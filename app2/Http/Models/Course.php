<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $fillable = ['name' , 'country' , 'city' , 'type' , 'duration_in_days' , 'duration_in_weeks' , 'duration_in_month' , 'start_date' , 'end_date' , 'level' , 'language' , 'dayly_hours' , 'total_hours' , 'price' , 'conditions' , 'advertisment_date' , 'advertisment_duration' , 'advertisment_photo']; 

	public function getCountry()
	{
		return $this->hasOne('App\Http\Models\Country' ,  'code' , 'country');
	}

	public function getCity()
	{
		return $this->hasOne('App\Http\Models\City' , 'id' , 'city');
	}
}
