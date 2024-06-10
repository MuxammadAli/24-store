<?php

namespace App\Http\Requests\Dashboard\Role;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
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
            'name'          => 'required|string',
            'permissions'   => 'required|array'
        ];
    }

    public function getName(): string
    {
        return (string) $this->get('name');
    }

    public function getPermissions(): array
    {
        return (array) $this->get('permissions');
    }
}
