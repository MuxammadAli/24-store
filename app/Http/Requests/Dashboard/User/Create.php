<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'username' => 'required|string|unique:staff,username',
            'role_id' => 'required|numeric',
            'password' => 'required|min:6',
        ];
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->get('username');
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return (int) $this->get('role_id');
    }
}
