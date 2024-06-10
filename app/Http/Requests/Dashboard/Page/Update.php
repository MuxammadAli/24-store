<?php

namespace App\Http\Requests\Dashboard\Page;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name'      => 'required|array',
            'name.*'    => 'required|string',
            'body'      => 'required|array',
            'body.*'    => 'required|string',
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
    public function getBody(): array
    {
        return $this->get('body');
    }
}
