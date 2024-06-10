<?php

namespace App\Http\Requests\Site\Product;

use App\Rules\Auth\Phone;
use Illuminate\Foundation\Http\FormRequest;

class BuyOneClickRequest extends FormRequest
{

    /**
     *
     */
    public function prepareForValidation()
    {
        $this->merge([
            'phone' => str_replace(['+', '(', ')', '-', ' '], '', $this->phone),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'phone' => [
                'required',
                'string',
                'regex:/(998)(90|91|92|93|94|95|96|97|98|99)[0-9]{7}/',
            ],
        ];
    }
}
