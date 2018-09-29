<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmbassiesRequest extends Request
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
        'name'    => 'required',
        'presence'    => 'required',
        'country'     => 'required',
        'city'        => 'required',
        'street'      => 'required',
        'site_url'    => 'required',
        'email'       => 'required',
        'mobile'      => 'required',
        'phone'       => 'required',
        'office'      => 'required'
        ];
    }
}
