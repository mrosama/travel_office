<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyOrder extends Model
{
	protected $fillable = ['companyId' , 'sectionId' , 'empId', 'order_type' , 'date_takeoff' , 'date_arrival' , 'dayNumbers' , 'country_takeoff' ,'city_takeoff' , 'country_arrival' , 'city_arrival'];

	public function companyName()
	{
		return $this->belongsTo('App\company' , 'companyId' , 'id');
	}

	public function orderType()
	{
		return $this->belongsTo('App\Orders_type' , 'order_type' , 'id');
	}

	public function sectionName()
	{
		return $this->belongsTo('App\CompanySection' , 'sectionId' , 'id');
	}

	public function empName()
	{
		return $this->belongsTo('App\CompanyEmployee' , 'empId' , 'id');
	}

	public function countryTakeOff()
	{
		return $this->belongsTo('App\Http\Models\Country' , 'country_takeoff' , 'code');
	}

	public function cityTakeOff()
	{
		return $this->belongsTo('App\Http\Models\City' , 'city_takeoff' , 'id');
	}

	public function countryArrival()
	{
		return $this->belongsTo('App\Http\Models\Country' , 'country_takeoff' , 'code');
	}

	public function cityArrival()
	{
		return $this->belongsTo('App\Http\Models\City' , 'city_takeoff' , 'id');
	}

}
