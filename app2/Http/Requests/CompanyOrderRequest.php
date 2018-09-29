<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyOrderRequest extends Request
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
        'empId'                 => 'required',
        'order_type'            => 'required',
        'date_takeoff'          => 'required|min:2',
        'date_arrival'          => 'required',
        'dayNumbers'            => 'required|numeric',
        'country_takeoff'       => 'required',
        'city_takeoff'          => 'required',
        'country_arrival'       => 'required',
        'city_arrival'          => 'required'
        ];
    }
}
