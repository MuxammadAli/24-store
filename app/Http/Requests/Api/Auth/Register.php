<?php

namespace App\Http\Requests\Api\Auth;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            'last_name' => 'required',
            'gender' => 'required',
            'birth_day' => 'nullable',
            'avatar' => 'nullable|mimes:jpeg,png,jpg',
            'category' => 'required'
        ];
    }



    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return (string) $this->get('first_name');
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return (string) $this->get('last_name');
    }

    /**
     * @return bool
     */
    public function getGender(): bool
    {
        return $this->get('gender') == 'men' ? true : false;
    }

    /**
     * @return string
     */
    public function getBirthDay(): string
    {
        return (string) $this->get('birth_day');
    }

    /**
     * @return false|string|null
     */
    public function getAvatar()
    {
        if ($this->hasFile('avatar')) {
            $path = "uploads/avatar/". Carbon::now()->format('Y/m/d');
            return $this->file('avatar')->store($path);
        }

        return null;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return (int) $this->get('category');
    }
}

