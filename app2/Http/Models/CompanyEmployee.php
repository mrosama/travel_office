<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyEmployee extends Model
{
	protected $fillable = ['companyId','sectionId','empName','nationality','mobile', 'phone' , 'email','ext','emp_photo','sex','birthDate',
	'No_civilRegistry','expireResidence','sourceResidence','photoResidence','passportNumber',
	'passport_issue_date' ,'passport_finish_date','sourcePassport','photoPassport','notes'];




	public function companyName()
	{
		return $this->belongsTo('App\company' , 'companyId' , 'id');
	}

	public function sectionName()
	{
		return $this->belongsTo('App\CompanySection' , 'sectionId' , 'id');
	}

	


}
