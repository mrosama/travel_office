<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class loginSiteRequest extends Request
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
				'name' 		=> 'required',
				'goal' 		=> 'required',
				'link' 		=> 'required',
				'username' 	=> 'required',
				'password' 	=> 'required',
				'type' 		=> 'required',
				'notes'		=> 'required'
		];
	}
}
