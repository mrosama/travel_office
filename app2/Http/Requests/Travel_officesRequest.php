<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Travel_officesRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => 'required',
                        'work_time' => 'required',
                        'owner_name' => 'required',
                        'country' => 'required',
                        'city' => 'required',
                        'commercial_record' => 'required',
                        'mailbox' => 'required',
                        'postal_code' => 'required',
                        'fax' => 'required',
                        'logo' => 'required',
                        'email' => 'required|email|unique:companies,email',
                        'mobile' => 'required|numeric',
                        'phone' => 'required|numeric',
                        'address' => 'required',
                        'lat' => 'required',
                        'lang' => 'required',
                        'userName' => 'required',
                        'password' => 'required|min:6|confirmed',
                        'password_confirmation' => 'required'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required',
                        'work_time' => 'required',
                        'owner_name' => 'required',
                        'country' => 'required',
                        'city' => 'required',
                        'commercial_record' => 'required',
                        'mailbox' => 'required',
                        'postal_code' => 'required',
                        'fax' => 'required',
                        'email' => 'required|email|unique:companies,email,' . $this->segment(3),
                        'mobile' => 'required|numeric',
                        'phone' => 'required|numeric',
                        'address' => 'required',
                        'lat' => 'required',
                        'lang' => 'required',
                        'userName' => 'required',
                        'password' => 'min:6|confirmed'
                    ];
                }
            default:break;
        }
    }

}
