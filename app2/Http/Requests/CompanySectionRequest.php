<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanySectionRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'companyId' => 'required',
			'sectionName' => 'required|min:2',
			'phone' => 'required',
			'mobile' => 'required',
			'email' => 'required|email',
			'fax' => 'required',
			'ext' => 'required',
		];
	}
}
