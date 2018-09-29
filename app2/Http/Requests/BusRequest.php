<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BusRequest extends Request
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
        'branch_id' => 'required|numeric',
        'supplier_id' => 'required|numeric',
        'number' => 'required',
        'model' => 'required',
        'color' => 'required',
        'size' => 'required',
        'license_number' => 'required',
        'notes' => 'required',
        'run_card_number' => 'required',
        'hajj_permit' => 'required',
        'permit_number' => 'required',
        'permit_duration' => 'required',
        'permit_date' => 'required|date',
        'permit_end_date' => 'required|date',
        ];
    }
}
