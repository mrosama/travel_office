<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Travel_officeFax extends Model
{
	protected $table = "travel_officefaxs";
	protected $fillable = ['fax', 'travel_officeId'];
}
