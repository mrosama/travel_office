<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmployeesRequest extends Request
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
        'partner_id'      => 'required',
        'name'            => 'required',
        'nationality'     => 'required',
        'gender'          => 'required',
        'mobile'          => 'required|numeric',
        'phone'           => 'required|numeric',
        'fax'             => 'required|numeric',
        'email'           => 'required|email',
        'responsible_for' => 'required',
        'skype'           => 'required',
        'other'           => 'required',
        'notes'           => 'required',
        ];
    }
}