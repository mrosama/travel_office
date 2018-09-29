<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MeetingsRequest extends Request
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
        'meet_place_id' => 'required',
        'meet_type_id' => 'required',
        'address' => 'required',
        'date' => 'required',
        'brief' => 'required',
        'employee_id' => 'required',
        ];
    }
}
