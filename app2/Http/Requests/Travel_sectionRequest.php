<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Travel_sectionRequest extends Request
{

	public function authorize()
	{
		return true;
	}


	public function rules()
	{
		return [
		'travel_officeId' => 'required',
		'sectionName' 	  => 'required|min:2',
		'phone' 		  => 'required',
		'mobile' 		  => 'required',
		'email' => 'required|email',
		'fax' => 'required',
		'ext' => 'required',
		];
	}
}
