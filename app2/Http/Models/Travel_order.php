<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel_order extends Model
{
	protected $fillable = ['travel_officeId' , 'sectionId' , 'empId', 'order_type' , 'date_takeoff' , 'date_arrival' , 'dayNumbers' , 'country_takeoff' ,'city_takeoff' , 'country_arrival' , 'city_arrival'];
	public function officeName()
	{
		return $this->belongsTo('App\Travel_office' , 'travel_officeId' , 'id');
	}


	public function sectionName()
	{
		return $this->belongsTo('App\Travel_section' , 'sectionId' , 'id');
	}


	public function empName()
	{
		return $this->belongsTo('App\Travel_employee' , 'empId' , 'id');
	}


	public function orderType()
	{
		return $this->belongsTo('App\Orders_type' , 'order_type' , 'id');
	}


}
