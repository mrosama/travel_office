<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BusStopsRequest extends Request
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
        'logo'                 => 'image',
        'name'                 => 'required',
        'tel'                  => 'required',
        'mobile'               => 'required',
        'email'                => 'required|email',
        'twitter'              => 'required',
        'face'                 => 'required',
        'skype'                => 'required',
        'commercial_record_no' => 'required',
        'country'              => 'required',
        'city'                 => 'required',
        'street'               => 'required',
        'notes'                => 'required',
        'mailbox'              => 'required',
        'postal_code'          => 'required',
        'fax'                  => 'required',
        'website'              => 'required',
        'commercial_reg_img'   => 'image',
        ];
    }
}
