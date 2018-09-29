<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Travel_officePhone extends Model
{
	protected $table = "travel_officephones";
	protected $fillable = ['number', 'travel_officeId'];
}
