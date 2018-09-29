<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight_reservation extends Model
{
	protected $fillable = ["client_id" , "bus_id" , "tourist_program_id" , 'notes'];

	public function client()
	{
	return $this->belongsTo('App\Client');
	}

	public function supplier()
	{
		return $this->belongsTo('App\BussesSupplier' , 'supplier_id');
	}

	public function bus()
	{
		return $this->belongsTo('App\Bus');
	}

	public function driver()
	{
		return $this->belongsTo('App\Driver');
	}

	public function touristProgram()
	{
		return $this->belongsTo('App\TouristProgram');
	}

	public function resrved_seats()
	{
		return $this->hasMany('App\Reserved_seats'  , 'flight_reserved_id');
	}
}
