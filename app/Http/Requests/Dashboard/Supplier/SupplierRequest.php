<?php

namespace App\Http\Requests\Dashboard\Supplier;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string login
 * @property string password
 */
class SupplierRequest extends FormRequest
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
        if ($this->isMethod('get')) return [];
        return [
            'login' => 'required',
            'password' => 'required|min:5'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'login.required' => 'Это поле обязательно к заполнению!',
            'password.required' => 'Это поле обязательно к заполнению!',
            'password.min' => 'Пароль должен состоять не менее чем из 5 символов.',
        ];
    }
}
