<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class BillRequest extends Request
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
        'client_id'             => 'required',
        'receipt'               => 'required',
        'country'               => 'required',
        'city'                  => 'required|numeric',
        'flight_type'           => 'required',
        'traveles'              => 'required',
        'date_go'               => 'required',
        'date_back'             => 'required',
        'dayNumbers'            => 'required',
        'dayNights'             => 'required',
        'phone'                 => 'required',
        'mobile'                => 'required',
        'email'                 => 'required',
        'price_sa'              => 'required',
        'price_ba'              => 'required',
        'price_us'              => 'required'

        ];
    }
}
