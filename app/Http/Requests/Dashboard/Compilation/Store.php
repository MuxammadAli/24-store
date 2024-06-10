<?php

namespace App\Http\Requests\Dashboard\Compilation;

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
            return [
                //
            ];
        }

        return [
            'title' => 'array',
            'title.*' => 'required',
            'published' => 'required',
            //'category_id' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function getTitle(): array
    {
        return $this->get('title');
    }

    /**
     * @return bool
     */
    public function getPublished(): bool
    {
        return $this->get('published');
    }


    /**
     * @return |null
     */
    public function getCategory()
    {
        if ($this->get('category_id')) {
            $this->get('category_id');
        }

        return null;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->get('position');
    }
}
