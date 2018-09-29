<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SalaryRequest extends Request
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
        'employee_id'              => 'required',
        'basic_salary'             => 'required|numeric',
        'transportation_allowance' => 'numeric',
        'house_allowance'          => 'numeric',
        'number_extra_hours'       => 'numeric',
        'number_extra_days'        => 'numeric',
        'holiday_allowance'        => 'numeric',
        'other_allowances'         => 'numeric',
        'amount_deducted'          => 'numeric',
        ];
    }
}
