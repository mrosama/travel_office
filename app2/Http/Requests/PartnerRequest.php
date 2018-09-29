<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PartnerRequest extends Request
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
        $rules = [
        'name'      => 'required',
        'type'      => 'required',
        'mobile'    => 'required|numeric',
        'site_url'  => 'required',
        'logo'      => 'image',
        'country'   => 'required',
        'city'      => 'required',
        'street'    => 'required',
        'latitude'    => 'required',
        'longitude'    => 'required',
        'mail_box'  => 'required',
        'fax'       => 'required',
        'skype'     => 'required',
        'twitter'   => 'required',
        'facebook'  => 'required',
        'other'     => 'required',
        'notes'     => 'required'
        ];

        foreach( range(0 , count($this->email) - 1) as $email){
            $rules['email.'.$email] = 'email|required';
            break;
        }

        return $rules; 
    }
}