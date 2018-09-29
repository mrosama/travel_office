<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VisasRequest extends Request
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

    public $rules = [
    // 'from_country'    => 'required',
    // 'to_country'      => 'required',
    // 'total_photos'    => 'required',
    // 'fill_out_form'   => 'required',
    // 'payment_of_fees' => 'required',
    // 'visa_duration'   => 'required',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->rules;

        // if ($this->method() == 'POST')
        // {
        //     $rules['file'] = 'required';
        // }

        return $rules;
    }
}
