<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class Update extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('get'))
        {
            return [];
        }
        return [
            'name' => 'required|array',
            'name.*' => 'required|string',
            'image' => 'nullable',
            'parent_id' => 'nullable',
            'popular' => 'nullable',
            'brands' => 'nullable|array',
            'position' => 'nullable|numeric'
        ];
    }

    public function getName(): array
    {
        return $this->get('name');
    }

    public function getSlug(): string
    {
        return Str::slug($this->get('name')['uz']);
    }

    public function getImage(): string
    {
        if ($this->hasFile('image'))
        {
            return $this->file('image')->store('vendor/uploads/categories', 'local');
        }
        else
        {
            return 'null';
        }
    }

    public function getPublished()
    {
        if ($this->get('published') == 'true') {
            return true;
        }

        return false;
    }

    public function getParentId()
    {
        if ($this->get('parent_id') > 0)
            return $this->get('parent_id');

        return null;
    }

    public function getPosition(): int
    {
        return $this->get('position');
    }

    public function getPopular(): bool
    {
        if ($this->get('popular') == 'false') {
            return false;
        }

        return true;
    }

    public function getIcon()
    {
        if ($this->get('icon') == 'null') {
            return null;
        }

        return $this->get('icon');
    }
}
