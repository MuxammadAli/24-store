<?php

namespace App\Http\Requests\Dashboard\City;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'name'   => 'required|array',
            'name.*' => 'required|string',
            'region_id' => 'required|numeric|exists:regions,id'
        ];
    }

    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->get('name');
    }


    public function getRegion(): int
    {
        return $this->get('region_id');
    }
}
