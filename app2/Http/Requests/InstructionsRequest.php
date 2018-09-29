<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InstructionsRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    protected $rules = [
        'type' => 'required|in:s,g,o',
        'title' => 'required',
        'country' => 'required|exists:countries,code',
        'city' => 'exists:cities,id',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = $this->rules;

        if ($this->method() == 'POST') {
            $rules['file'] = 'required';
        }

        return $rules;
    }

}
