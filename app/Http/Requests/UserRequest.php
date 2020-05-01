<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,'.$this->segment(2),
        ];
    }
}
