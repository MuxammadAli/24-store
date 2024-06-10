<?php

namespace App\Http\Requests\Dashboard\SpecialOffer;

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
            'name' => 'required|array',
            'name.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'link' => 'required|string',
            'image' => 'required|image'
        ];
    }

    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->get('name');
    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->get('description');
    }

    public function getLink(): string
    {
        return $this->get('link');
    }

}
