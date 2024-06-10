<?php

namespace App\Http\Requests\Dashboard\Post;

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
        if ($this->isMethod('get')) {
            return [];
        }

        return [
            'name'      => 'required|string',
            'content'   => 'required|string',
            'image'     => 'nullable|image',
            'language'  => 'required|string',
            'topped'    => 'nullable|boolean',
            'type'      => 'required|string|in:news,article,sales,media'
        ];
    }

    public function getName():string
    {
        return (string) $this->get('name');
    }

    public function getBody():string
    {
        return (string) $this->get('content');
    }

    public function getLanguage():string
    {
        return (string) $this->get('language');
    }

    public function getTopped(): bool
    {
        return (bool) $this->get('topped');
    }

    public function getType(): string
    {
        return (string) $this->get('type');
    }
}
