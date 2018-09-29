<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TouristProgramRequest extends Request
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
        'name'            => 'required',
        'trip_id'            => 'required',
        'supervisors'     => 'required',
        'going_date'      => 'required|date',
        'flight_days_no'  => 'required',
        'flight_hours_no' => 'required',
        'from_country'    => 'required',
        'from_city'       => 'required',
        'from_place'      => 'required',
        'to_country'      => 'required',
        'to_city'         => 'required',
        'to_place'        => 'required',
        'program_notes'   => 'required',
        'launching_notes' => 'required',
        'arriving_notes'  => 'required',
        'launch_hour'     => 'required',
        ];
    }
}
