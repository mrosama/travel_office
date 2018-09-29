<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmployeeRequest extends Request
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
     'office_id'              =>'required',
     'name'                   =>'required',
     'mobile'                 =>'required|integer',
     'work_type'              =>'required',
     'gender'                 =>'required|in:male,female',
     'email'                  =>'required|email',
     'salary'                 =>'numeric',
     'civil_registry_number'  =>'numeric',
     'civil_registry_image'   =>'image',
     'profile_img '           =>'image',
     'iban'                   =>'numeric',
     'account_number'         =>"integer",
     'holidays_number'        =>'integer',
     'hire_date'              =>'date'
     ];
 }
}
