<?php

namespace App\Http\Requests\Dashboard\Color;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get'))
        {
            return [];
        }

        return [
            'name' => 'required|array',
            'name.*' => 'required|string'
        ];
    }

    public function getName(): array
    {
        return (array) $this->get('name');
    }

    public function getColor(): string
    {
        return (string) $this->get('color');
    }
}
