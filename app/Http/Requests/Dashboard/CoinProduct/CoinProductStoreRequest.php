<?php

namespace App\Http\Requests\Dashboard\CoinProduct;

use Illuminate\Foundation\Http\FormRequest;

class CoinProductStoreRequest extends FormRequest
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
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name' => 'array',
            'name.*' => 'required',
            'body' => 'array',
            'body.*' => 'nullable',
            'short_body' => 'array',
            'short_body.*' => 'max:300',
            'price' => 'required|numeric',
            'screens' => 'array',
            'screens.*.image' => 'required|mimes:jpeg,png,jpg',
        ];
    }
}
