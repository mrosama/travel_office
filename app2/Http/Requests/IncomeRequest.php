<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class IncomeRequest extends Request
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
        'employee_id'           => 'required',
        'receipt'               => 'required',
        'bank'               => 'required',
        'receipt_type'          => 'required',
        'receipt_date'          => 'required',
        'receipt_daily_total'   => 'required',
        'receipt_daily_number'  => 'required',
        'money_source'          => 'required',
        'notes'                 => 'required',
        'total'                 => 'required',
        ];
    }
}
