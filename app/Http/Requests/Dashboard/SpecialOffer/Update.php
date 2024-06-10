<?php

namespace App\Http\Requests\Dashboard\SpecialOffer;

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
            'name' => 'required|array',
            'name.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'link' => 'required|string',
            'image' => 'nullable|image'
        ];
    }


    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->get('name');
    }

    public function getDescription(): array
    {
        return $this->get('description');
    }

    public function getLink(): string
    {
        return $this->get('link');
    }
}
