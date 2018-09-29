<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel_employee extends Model
{
	protected $fillable = ['travel_officeId','sectionId','empName','nationality','mobile', 'phone' , 'email','ext','emp_photo','sex','birthDate',
	'No_civilRegistry','expireResidence','sourceResidence','photoResidence','passportNumber',
	'passport_issue_date' ,'passport_finish_date','sourcePassport','photoPassport','notes'];



	public function officeName()
	{
		return $this->belongsTo('App\Travel_office' , 'travel_officeId' , 'id');
	}

	public function sectionName()
	{
		return $this->belongsTo('App\Travel_section' , 'sectionId' , 'id');
	}
}
