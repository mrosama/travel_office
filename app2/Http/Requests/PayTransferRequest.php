<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PayTransferRequest extends Request
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
        'partner_id' => 'required',
        'required_amount' => 'required',
        'bill_photo' => 'image',
        'paid_amount' => 'required',
        'remaining_amount' => 'required',
        'pay_from_date' => 'required|date',
        'pay_to_date' => 'required|date',
        'notes' => 'required',
        ];
    }
}
