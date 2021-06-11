<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'string|min:2|max:50|required',
            'last_name'=>'string|min:2|max:50',
            'birthDay'=>'string|min:4|max:10',
            'password'=>'string|min:6|max:20|required',
            'country'=>['string', 'min:2', 'max:20', 'required'],
            'city'=>'string|min:2|max:50|required',
            'mobile'=>'string|min:10|max:15',
        ];
    }
}
