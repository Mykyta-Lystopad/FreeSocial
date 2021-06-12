<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'=>'string|min:2|max:50',
            'last_name'=>'string|min:2|max:50',
            'birthDay'=>'string|min:4|max:10',
            'age'=>'numeric|min:5|max:150',
            'email'=>'email|unique:users|required',
            'country'=>['string', 'min:2', 'max:20'],
            'city'=>'string|min:2|max:50',
            'mobile'=>'string|min:10|max:15',
            'role'=>'string|min:4|max:10',
        ];
    }
}
