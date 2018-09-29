<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class Travel_ordersRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
        'travel_officeId'       => 'required',
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
