<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Travel_officeEmail extends Model
{
	protected $table = "travel_officeemails";
	protected $fillable = ['email', 'travel_officeId'];
}
