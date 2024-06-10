<?php

namespace App\Http\Requests\Dashboard\Brand;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ];
    }


    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->get('name');
    }
}
