<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class ClientsOrdersRequest extends Request
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
        'client_id' => 'required',
        'order_type' => 'required',
        ];
    }
}