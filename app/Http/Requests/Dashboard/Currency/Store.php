<?php

namespace App\Http\Requests\Dashboard\Currency;

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
            'dollar' => 'required',
            'euro' => 'required'
        ];
    }

    /**
     * @return int
     */
    public function getDollar(): int
    {
        return $this->get('dollar');
    }

    /**
     * @return int
     */
    public function getEuro(): int
    {
        return $this->get('euro');
    }
}
