<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentsRequest extends Request
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

    public function rules()
    {
        return [    
        'photo'       => 'image',
        'name'        => 'required',
        'country'     => 'required|exists:countries,code',
        'city'        => 'required|exists:cities,id',
        'birth_date'  => 'required',
        'nationality' => 'required',
        'email'       => 'required|email',
        'mobile'      => 'required',
        'notes'       => 'required',
        ];
    }
}
