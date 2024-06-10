<?php

namespace App\Http\Requests\Dashboard\Partner;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'name' => 'required|string',
            'image' => 'required|image'
        ];
    }

    /**
     * @return array
     */
    public function getName(): string
    {
        return $this->get('name');
    }

}
