<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class ExpensesRequest extends Request
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
        'exchangeType_id'    => 'required',
        'income_date'    => 'required',
        'income_period'    => 'required',
        'amount_paid'    => 'required',
        'remaning_amount'    => 'required',
        'total_amount'    => 'required',
        'notes'    => 'required',
        ];
    }
}
