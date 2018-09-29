<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BankingAccoountsRequest extends Request
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
        'partner_id'         => 'required',
        'country'            => 'required',
        'city'               => 'required',
        'bank_name'          => 'required',
        'iban'               => 'required',
        'bank_number'        => 'required',
        'bank_account_owner' => 'required',
        'other'              => 'required',
        'notes'              => 'required',
        ];

    }
}