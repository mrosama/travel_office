<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Embassy_branchesRequest extends Request
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
        'embassy_id' => 'required|integer',
        'name'       => 'required',
        'country'    => 'required',
        'city'       => 'required',
        'street'     => 'required',
        'email'      => 'email',
        'mobile'     => 'numeric',
        'phone'      => 'numeric',
        ];
    }
}
