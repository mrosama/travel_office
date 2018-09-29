<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
	protected $fillable =['name' , 'work_type' ,  'work_time' , 'owner_name' , 'country' , 'city' , 'commercial_record' , 'mailbox' , 'postal_code' , 'fax' ,  'logo' ,  'email' , 'mobile' , 'phone' , 'address' , 'lat', 'lang' , 'userName' , 'password'];


	public function cityName()
	{
		return $this->belongsTo('App\Http\Models\City' , 'city' , 'id');
	}

	public function countryName()
	{
		return $this->belongsTo('App\Http\Models\Country' , 'country' , 'code');
	}
}
