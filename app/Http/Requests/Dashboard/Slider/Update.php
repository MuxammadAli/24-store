<?php

namespace App\Http\Requests\Dashboard\Slider;

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
            'name' => 'required|string',
            'link' => 'nullable|string',
            'language' => 'required|string',
            'type' => 'required|string|in:desktop,mobile',
            'image' => 'nullable|image',
            'placement' => 'required|string|in:top,middle'
        ];
    }

    public function getName(): string
    {
        return $this->get('name');
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        if ($this->get('link')) {
            return $this->get('link');
        }

        return '#';
    }

    public function getLanguage(): string
    {
        return $this->get('language');
    }

    public function getType(): string
    {
        return $this->get('type');
    }

    public function getPlacement(): string
    {
        return $this->get('placement');
    }

    public function getPublished()
    {
        if ($this->get('published')) {
            return true;
        }

        return false;
    }
}
