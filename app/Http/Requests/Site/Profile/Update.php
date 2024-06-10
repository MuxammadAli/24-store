<?php

namespace App\Http\Requests\Site\Profile;

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
        return [
            'first_name' => 'required',
            'name' => 'required',
            'inn' => 'required|int|digits:9|unique:users,inn,' . auth()->id()
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Заполните поле Название магазина!',
            'first_name.required' => 'Заполните поле Имя!',
            'inn.required' => 'Заполните поле INN!',
            'inn.digits' => 'ИНН должен состоять из 9 символов!',
            'inn.int' => 'ИНН должен состоять только из цифр!',
            'inn.unique' => 'ИНН уже занят.'
        ];
    }
}
