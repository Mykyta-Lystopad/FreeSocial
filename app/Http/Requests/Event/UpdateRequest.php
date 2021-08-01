<?php

namespace App\Http\Requests\Event;

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
//            'eventImages' => 'string|min:20',
            'title' => 'string|min:2|max:100|required',
            'description' => 'string|min:10|max:1000|required',
            'coordinates' => 'string|min:10',
            'departure' => 'string|min:4|max:50|required'
        ];
    }
}
