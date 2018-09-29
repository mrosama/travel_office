<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Travel_officeMobile extends Model
{
	protected $table = "travel_officemobiles";
	protected $fillable = ['number', 'travel_officeId'];
}
