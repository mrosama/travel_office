<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyEmployeeRequest extends Request
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
        'companyId'             => 'required',
        'sectionId'             => 'required',
        'empName'               => 'required|min:2',
        'nationality'           => 'required',
        'mobile'                => 'required|numeric',
        'phone'                => 'required|numeric',
        'email'                => 'required|email',
        'ext'                   => 'required',
        'sex'                   => 'required',
        'birthDate'             => 'required',
        'No_civilRegistry'      => 'required',
        'expireResidence'       => 'required',
        'sourceResidence'       => 'required',
        'passportNumber'        => 'required',
        'passport_issue_date'   => 'required',
        'passport_finish_date'  => 'required',
        'sourcePassport'        => 'required',
        ];
    }
}
