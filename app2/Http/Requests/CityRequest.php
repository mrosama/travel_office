<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CityRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'country_id' => 'required',
            'name' => 'required|min:2',
            'lineOpen' => 'required'
        ];
    }

}
