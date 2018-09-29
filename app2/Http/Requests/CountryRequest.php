<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CountryRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        if ($this->method() != 'PUT') {
            return [
                'name' => 'required|min:2',
                'code' => 'required',
                'lineOpen' => 'required',
                'logo' => 'required|image'
            ];
        } else {
            return [
                'name' => 'required|min:2',
                'code' => 'required',
                'lineOpen' => 'required',
            ];
        }
    }

}
