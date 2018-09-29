<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FlightReservationRequest extends Request
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
        'client_id' => 'required|numeric',
        'bus_id' => 'required|numeric',
        'tourist_program_id' => 'required|numeric',
        ];
    }
}
