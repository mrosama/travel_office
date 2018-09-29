<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class InstituteRequest extends Request
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
        'country_code'             => 'required',
        'city'                     => 'required',
        'name'                     => 'required',
        'phone'                    => 'required',
        'mobile'                  => 'required',
        'web_site'                => 'required',
        'postal_code'             => 'required',
        'address'                 => 'required',
        ];
    }
}
