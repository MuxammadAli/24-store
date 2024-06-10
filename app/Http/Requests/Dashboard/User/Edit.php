<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class Edit extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'category_id' => 'required',
            'role_id' => 'required',
            'birth_day' => 'required',
        ];
    }
}
