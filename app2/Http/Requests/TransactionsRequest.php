<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransactionsRequest extends Request
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
        'transaction_type_id' => 'required|exists:transactions_types,id',
        'site' => 'required',
        'paper_work' => 'required',
        'country' => 'required|exists:countries,code',
        'city' => 'required|exists:cities,id',
        'email' => 'required',
        'mobile' => 'required',
        'notes' => 'required',
        ];
    }
}
