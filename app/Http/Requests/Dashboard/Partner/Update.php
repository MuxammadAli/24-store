<?php

namespace App\Http\Requests\Dashboard\Partner;

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
            'name' => 'required|string',
            'image' => 'nullable|image'
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
