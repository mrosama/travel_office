<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserved_seats extends Model
{
	protected $fillable = ["flight_reserved_id" , "bus_id" , "client_id" , "tourist_program_id" , "seat_no"];

}
