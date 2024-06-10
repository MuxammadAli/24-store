<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRegionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'region' => 'required|integer',
            'entry_price' => 'nullable',
            'price_percents' => 'nullable',
            'discount_percents' => 'nullable',
            'count' => 'required'
        ];
    }
}
