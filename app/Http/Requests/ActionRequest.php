<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->getMethod() == 'PATCH') {
            return [
                'action' => 'sometimes|required'
            ];
        }

        return [
            'actions' => 'required|array|min:1',
        ];

    }
}
